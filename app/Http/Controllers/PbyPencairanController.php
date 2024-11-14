<?php

namespace App\Http\Controllers;

use App\Lib\LibAkun;
use App\AktSetting;
use App\ChartAccount;
use App\Lib\LibRekening;
use App\Lib\LibTransaksi;
use App\Lib\CreateJurnal;
use App\Mail\AgtPencairanMail;
use App\PbyMaster;
use App\MsAnggota;
use App\PbyPengajuan;
use App\PbyRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;


class PbyPencairanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $AllPengajuan = PbyPengajuan::where('status_pengajuan', 'Menunggu Pencairan')->orWhere('status_pengajuan', 'Pencairan Dibatalkan')->orWhere('status_pengajuan', 'Pencairan Selesai')->get();
        $ProsesCair = PbyPengajuan::where('status_pengajuan', 'Menunggu Pencairan')->get();
        $SelesaiCair = PbyPengajuan::where('status_pengajuan', 'Pencairan Selesai')->get();
        $BatalCair = PbyPengajuan::where('status_pengajuan', 'Pencairan Dibatalkan')->get();

        $Akun = ChartAccount::orderby('kde_akun','ASC')->get();
        $AktSetting  = AktSetting::first();
        $AkunKas        = $AktSetting->akun_kas;

        return view('admin.pby_rekening.pencairan', compact('AllPengajuan', 'ProsesCair', 'SelesaiCair', 'BatalCair', 'Akun', 'AkunKas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $IdPengajuan = $req->input('id');
        $PbyPengajuan   = PbyPengajuan::findorfail($IdPengajuan);

        $NoPengajuan    = $PbyPengajuan->no_pengajuan;
        $IdPinjaman     = $PbyPengajuan->id_pinjaman;
        $IdAnggota      = $PbyPengajuan->id_anggota;
        $NamaAnggota    = $PbyPengajuan->Anggota->nama_anggota;
        $Nominal        = $PbyPengajuan->nominal;
        $Jangka         = $PbyPengajuan->jangka;

        /// get detail produk pinjaman
        $PbyMaster      = PbyMaster::findorfail($IdPinjaman);
        $KodePby        = $PbyMaster->kode;
        $AkunPby        = $PbyMaster->akun_produk;
        $AkunAdm        = $PbyMaster->akun_adm;
        $PersenJasaPby  = $PbyMaster->persen_jasa;
        $PersenByaAdm   = $PbyMaster->bya_adm;
        $Norek          = LibRekening::CreateRekPby($KodePby);
        $TglCair        = Carbon::now()->format('Y-m-d');
        $JthTempo       = Carbon::now()->addMonth($Jangka)->format('Y-m-d');
        
        $NomByaAdm      = $Nominal*($PersenByaAdm/100);
        $UserId         = Auth::user()->id;

        $PbyRek = PbyRekening::create([
            'id_anggota' => $IdAnggota,
            'id_pinjaman' => $IdPinjaman,
            'id_pengajuan' => $IdPengajuan,
            'no_rek' => $Norek,
            'tgl_cair' => $TglCair,
            'jangka' => $Jangka,
            'jth_tempo' => $JthTempo,
            'plafond' => $Nominal,
            'bya_adm' => $NomByaAdm,
            'angske' => 1,
            'saldo_awal_pokok_sys' => 0,
            'saldo_awal_jasa_sys' => 0,
            'saldo_akhir' => $Nominal,
            'user_id' => $UserId, 
            'status' => 'Aktif'
        ]);  
        
        $IdNorek    = $PbyRek->id;

        /// Buat Jadwal Angsuran
        LibRekening::CreateJdwAngs($IdNorek, $PersenJasaPby,$Nominal, $Jangka, $TglCair);

        /// Tandai Pencairan
        $PbyPengajuan->update([
            'no_rek' => $Norek,
            'status_pengajuan' => 'Pencairan Selesai',
            'approve_by_hr' => 1,
            'approve_by_cfo' => 1
        ]);

        /// Catat di Akunting
        /// KAS - Kredit || Akun Pinjaman - Debet
        $Tgl        = Carbon::now()->format("Ymd");
        $NoBukti    = LibTransaksi::NoBukti(substr($Tgl,-6));
        $AkunKAS    = $req->input('akun_kas');
        // $AkunKAS    = LibAkun::AkunKAS();
        $KetCair    = "Pencairan Pinjaman A.n ".$NamaAnggota;
        $KetAdm     = "Pendptan Adm Pinjaman A.n ".$NamaAnggota;

        $Tanggal        = Carbon::now()->format("Y-m-d");


        // Jurnal Pencairan
        CreateJurnal::AktMutasi($NoBukti, $AkunPby, $Nominal, 'debet', $KetCair, 'Pencairan', $Tanggal);
        CreateJurnal::AktMutasi($NoBukti, $AkunKAS, $Nominal, 'kredit', $KetCair, 'Pencairan', $Tanggal);

        if ($NomByaAdm > 0) {
            // Jurnal Adm Pencairan
            CreateJurnal::AktMutasi($NoBukti, $AkunKAS, $NomByaAdm, 'debet', $KetAdm, 'AdmPencairan', $Tanggal );
            CreateJurnal::AktMutasi($NoBukti, $AkunAdm, $NomByaAdm, 'kredit', $KetAdm, 'AdmPencairan', $Tanggal );
        }

        $MsAnggota    = MsAnggota::findorfail($IdAnggota);
        $EmlAnggota = $MsAnggota->email;
        $urlAdmin    = env("APP_URL").'/anggota/pinjaman';
        $data = [
            'url' => $urlAdmin,
            'nama_anggota' => $MsAnggota->nama_anggota,
        ];
        if(companySetting("notif_email") == 1){
        Mail::to($EmlAnggota)->send(new AgtPencairanMail($data));            
        }
        

        Session::flash('flash_message', 'Pencairan pinjaman telah dilakukan');
        return redirect('admin/pby_rekening');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
