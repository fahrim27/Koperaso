<?php

namespace App\Http\Controllers;

use App\AgtTransaksi;
use App\Mail\AgtSetoranMail;
use Illuminate\Http\Request;
use App\MsAnggota;
use App\SimpRekening;
use App\PbyRekening;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Lib\LibMaster;
use App\Lib\LibNotification;
use Mail;
use Session;

class AgtSimpananController extends Controller
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
        $UserId     = Auth::user()->id;
        $Anggota    = MsAnggota::where('user_id', $UserId)->get();
        $IdAnggota  = [];
        $NamaAgt    = [];
        $Perush     = [];
        foreach($Anggota as $a){
            $IdAnggota = $a->id;           
            $NamaAgt    = $a->nama_anggota;
            $Perush     = $a->Perusahaan->nama;
        }

        $SimpRek    = SimpRekening::where('id_anggota', $IdAnggota)->get();
        $PbyRek     = PbyRekening::where('id_anggota', $IdAnggota)->get();

        $Simpanan = DB::select("select sum(saldo_akhir) as jml_simp from simp_rekening where status_aktif='Y' and id_anggota=?",[$IdAnggota]);
        $JmlSimp = [];
        foreach($Simpanan as $s){
            $JmlSimp = $s->jml_simp;           
        }

        return view('anggota.simpanan.index', compact('NamaAgt', 'SimpRek', 'PbyRek', 'JmlSimp', 'Perush'));
    }

    public function setoran_index()
    {
        $UserId     = Auth::user()->id;
        $Anggota    = MsAnggota::where('user_id', $UserId)->get();
        $IdAnggota  = [];
        $NamaAgt    = [];
        $Perush     = [];
        foreach($Anggota as $a){
            $IdAnggota = $a->id;           
            $NamaAgt    = $a->nama_anggota;
            $Perush     = $a->Perusahaan->nama;
        }

        $AgtTrx     = AgtTransaksi::where('id_anggota', $IdAnggota)->get();
        // dd($AgtTrx);
        return view('anggota.simpanan.setoran_index', compact('NamaAgt',  'AgtTrx','Perush'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req,[
            'no_rekening' => 'required',
            'jumlah' => 'required',
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,jpeg,png|max:2000',  
        ]);
        $IdRekening      = $req->input('no_rekening');
        $Tgl        = Carbon::now()->format("Ymd");
        $JnsMutasi  = 'Setoran';
        $Ket        = $req->input('keterangan');
        $Nominal    = str_replace(".","",$req->input('jumlah'));
        $SimpRek    = DB::select('select r.*, a.nama_anggota, m.nama, m.akun_produk from simp_rekening r, simp_master m, ms_anggota a where r.id_anggota=a.id and r.id_simpanan=m.id and r.id=?', [$IdRekening]);
        $IdAnggota  = [];
        $NamaSimp = [];
        $NamaAgt = [];
        
        foreach($SimpRek as $s){
            $NamaSimp   = $s->nama;
            $NamaAgt    = $s->nama_anggota;
            $IdAnggota  = $s->id_anggota;
        }   

        if ($Ket == null){            
            $Keterangan = "Setoran ".$NamaSimp." A.n ".$NamaAgt;
        }else{
            $Keterangan = $Ket;
        }

        if ($req->hasfile('filename')) {            
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$req->file('filename')->getClientOriginalName());
            $req->file('filename')->move(public_path('images'), $filename);
        }

        $idTrx  = AgtTransaksi::create([
            'tanggal' => $Tgl,
            'id_anggota' => $IdAnggota,
            'id_norek' => $IdRekening,
            'nominal' => $Nominal,
            'jenis' => $JnsMutasi,
            'keterangan' => $Keterangan,
            'lampiran' => $filename, 
            'status' => 'Menunggu Konfirmasi'
        ]);

        
        /// Kirim Notif email ke pengurus
        $MsAnggota = MsAnggota::findorfail($IdAnggota);
        // $Email  = $MsAnggota->email;
        $Att         = public_path('images/'.$filename);
        // dd($Att);
        $urlAdmin    = env("APP_URL").'/admin/simp_verifikasi/detail/'.$idTrx->id;
        $data = [
            'url' => $urlAdmin,
            'no_anggota' => $MsAnggota->no_anggota,
            'nama' => $MsAnggota->nama_anggota,
            'perusahaan' => $MsAnggota->Perusahaan->nama." - ".$MsAnggota->Department->nama,
            'tanggal' => Carbon::parse($Tgl)->translatedFormat('d F Y'),
            'jenis_setoran' => $NamaSimp,
            'nominal' => $Nominal,
            'lampiran' => $Att,
            'body' => 'Setoran Anggota'
        ];

        if(companySetting("is_notification") == 1){
            //// CREATE NOTIF
            $Ket    = "Setoran ".$NamaSimp." A.n ".$MsAnggota->nama_anggota;
            LibNotification::CreateNotif($IdAnggota, $IdRekening,0, 0,'Pengajuan', $Ket,'Admin', 0);
        }
        

        $EmailKetua = LibMaster::getPengurus('Ketua');
        $EmailSekr = LibMaster::getPengurus('Sekretaris');
        $EmailBend = LibMaster::getPengurus('Bendahara');
        
        
    ///// KIRIM EMAIL KE PENGURUS
    //    Mail::send('anggota.simpanan.mail_setoran', $data, function($message) use($data) {
    //         $EmailKetua = LibMaster::getPengurus('Ketua');
    //         $EmailSekr = LibMaster::getPengurus('Sekretaris');
    //         $EmailBend = LibMaster::getPengurus('Bendahara');
    //         $message->from('admin@koperasiuntungbareng.com', 'Koperasi')
    //             ->sender('admin@koperasiuntungbareng.com', 'Koperasi')
    //             ->to($EmailKetua)
    //             ->cc([$EmailSekr, $EmailBend])
    //             ->attach($data['lampiran'])
    //             ->subject("Setoran Simpanan Anggota");
 
    //     });


        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('anggota/simpanan/setoran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SimpRek = SimpRekening::findorfail($id);
        $IdRek  = $SimpRek->id;
        $Norek  = $SimpRek->no_rek;

        $SimpMutasi = DB::select("select * from simp_mutasi where no_rek='$Norek' order by tanggal, no_bukti ASC");
        $JmlMutasi  = DB::select("select sum(debet) as debet, sum(kredit) as kredit from simp_mutasi where no_rek='$Norek' group by no_rek");

        $JmlDebet  = [];
        $JmlKredit  = [];
        
        foreach($JmlMutasi as $j){
            $JmlDebet   = $j->debet;
            $JmlKredit   = $j->kredit;
        }   

        return view('anggota.simpanan.show', compact('SimpRek', 'SimpMutasi', 'JmlDebet', 'JmlKredit'));
    }

    public function setoran()
    {
        $UserId     = Auth::user()->id;
        $Anggota    = MsAnggota::where('user_id', $UserId)->get();
        $IdAnggota  = [];
        
        foreach($Anggota as $j){
            $IdAnggota   = $j->id;
        }   
        $SimpRek    = SimpRekening::where('status_aktif', 'Y')->where('id_simpanan','3')->where('id_anggota', $IdAnggota)->get();

        return view('anggota.simpanan.create', compact('SimpRek'));
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
        $id = $req->input('id');

        $AgtTrx = AgtTransaksi::findorfail($id);
        $AgtTrx->delete();

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('anggota/simpanan/setoran');

    }
}
