<?php

namespace App\Http\Controllers;

use App\AgtTransaksi;
use App\MsAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Lib\LibAkun;
use App\Lib\LibTransaksi;
use App\Lib\CreateJurnal;
use App\SimpMutasi;
use Illuminate\Support\Facades\Auth;
use Session;


class SimpVerifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AgtTrx = AgtTransaksi::where('jenis','Setoran')->get();

        return view('admin.simp_verifikasi.index', compact('AgtTrx'));
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
        // dd($req);
        $AgtTrx = AgtTransaksi::findorfail($req->input('id'));
        
        $IdRekening      = $AgtTrx->id_norek;
        $Nominal         = $AgtTrx->nominal;
        $Keterangan      = $AgtTrx->keterangan;

        $Tgl        = Carbon::now()->format("Ymd");
        $NoBukti    = LibTransaksi::NoBukti(substr($Tgl,-6));
        $AkunKas    = LibAkun::AkunKAS();
        $JnsMutasi  = $req->input('jns_mutasi');
        $SimpRek    = DB::select('select r.*, a.nama_anggota, m.nama, m.akun_produk from simp_rekening r, simp_master m, ms_anggota a where r.id_anggota=a.id and r.id_simpanan=m.id and r.id=?', [$IdRekening]);
        $NamaSimp = [];
        $NamaAgt = [];
        $Norek = [];
        $AkunSimp  = [];
        $SaldoSimp  = [];
        
        foreach($SimpRek as $s){
            $NamaSimp   = $s->nama;
            $NamaAgt    = $s->nama_anggota;
            $Norek      = $s->no_rek;
            $AkunSimp   = $s->akun_produk;
            $SaldoSimp  = $s->saldo_akhir;
        }        
        
        $Debet  = 0;
        $Kredit = $Nominal;  
        $Tanggal       = Carbon::now()->format("Y-m-d");
        
        $UserId=Auth::user()->id;;
        $AktJnsMutasi    = "Simpanan";
        SimpMutasi::create([
            'id_norek' => $IdRekening,
            'no_bukti' => $NoBukti,
            'tanggal'  => $Tgl,
            'no_rek'    => $Norek, 
            'keterangan' => $Keterangan,
            'debet' => $Debet, 
            'kredit' => $Kredit,
            'user_id' =>$UserId,
        ]);

        /// Setoran Simpanan 
        /// Kas - Debet || Akun Simp - Kredit
        CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Nominal, 'debet', $Keterangan, $AktJnsMutasi, $Tanggal);
        CreateJurnal::AktMutasi($NoBukti, $AkunSimp, $Nominal, 'kredit', $Keterangan, $AktJnsMutasi, $Tanggal);
        $UpdateSaldo = DB::update('update simp_rekening set saldo_akhir = saldo_akhir+? where no_rek = ?', [$Nominal, $Norek]);

        // notifikasi dengan session
		Session::flash('flash_message', 'Setoran simpanan berhasil diverifikasi');
        return redirect('admin/simp_verifikasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $AgtTrx = AgtTransaksi::findorfail($id);
        $MsAnggota  = MsAnggota::findorfail($AgtTrx->id_anggota);
        // dd($MsAnggota);

        return view('admin.simp_verifikasi.show', compact('AgtTrx', 'MsAnggota'));

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
    public function destroy(Request $req)
    {
        $AgtTrx = AgtTransaksi::findorfail($req->input('id'));

        $AgtTrx->delete();

        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect('admin/simp_verifikasi');
    }
}
