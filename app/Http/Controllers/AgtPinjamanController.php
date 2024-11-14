<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MsAnggota;
use App\PbyMaster;
use App\PbyPengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Lib\LibTransaksi;
use App\PbyJadwal;
use App\PbyMutasi;
use App\PbyRekening;
use App\PbySimulasi;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Session;
use App\Lib\LibMaster;
use App\Lib\LibNotification;
use App\Mail\PbyPengajuanMail;
use App\Mail\PengajuanAnggotaMail;
use Mail;


class AgtPinjamanController extends Controller
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

        $PbyPengajuan   = PbyPengajuan::where('id_anggota', $IdAnggota)->get();   

        return view('anggota.pengajuan.index', compact('PbyPengajuan', 'IdAnggota','NamaAgt', 'Perush',));
    }

    public function datarekening()
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

        $PbyRekening   = PbyRekening::where('id_anggota', $IdAnggota)->get();   
        // dd($PbyPengajuan);     

        return view('anggota.pinjaman.index', compact('PbyRekening', 'IdAnggota','NamaAgt', 'Perush',));
    }

    public function simulasi_pinjaman(){
        $UserId     = Auth::user()->id;
        DB::delete("delete from pby_simulasi where user_id=?",[$UserId]);
        $PbyMaster  = PbyMaster::where('kode','50')->get();
        $DataSimulasi   = [];
        $IdPinjaman     = [];
        foreach($PbyMaster as $p){
            $IdPinjaman = $p->id;           
        }

        return view('anggota.pinjaman.simulasi', compact('DataSimulasi','IdPinjaman' ));
    }

    public function proses_simulasi(Request $req)
    {
        // dd($req);
        $this->validate($req,[
            'jangka' => 'required',
            'jumlah' => 'required'
        ]);
        $Plafond    = str_replace(".","",$req->input('jumlah'));
        $Jangka   = $req->input('jangka');
        $IdPinjaman     = $req->input(('id_pinjaman'));
        $PbyMaster  = PbyMaster::findorfail($IdPinjaman);
        $Jasa       = $PbyMaster->persen_jasa;
        $UserId     = Auth::user()->id;
        DB::delete("delete from pby_simulasi where user_id=?",[$UserId]);

        for ($i=1; $i <= $Jangka; $i++) { 
            
            $AngPokok  = round($Plafond/$Jangka,0);
            $AngJasa    = floor($Plafond*($Jasa/100)/100)*100;


            PbySimulasi::create([
                'angske' => $i,
                'angs_pokok'=> $AngPokok,
                'angs_jasa' => $AngJasa,
                'user_id' => $UserId,
            ]);
        }
        $DataSimulasi   = PbySimulasi::where('user_id', $UserId)->get();
        return view('anggota.pinjaman.simulasi', compact('IdPinjaman','DataSimulasi'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $PbyMaster  = PbyMaster::where('jenis_pinjaman', 'Tunai')->get();
        // $IdPinjaman     = [];
        // foreach($PbyMaster as $p){
        //     $IdPinjaman = $p->id;           
        // }

        return view('anggota.pengajuan.create', compact( 'IdAnggota','NamaAgt', 'Perush', 'PbyMaster'));
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
            'jumlah' => 'required',
            'jangka' => 'required',
            'keperluan' => 'required',
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,jpeg,png|max:2000',  
            // 'jaminan' => 'required',
        ]);
        $Tgl        = Carbon::now()->format("Ymd");
        $NoPengajuan = LibTransaksi::NoPengajuan(substr($Tgl,-6));
        $Tanggal    = Carbon::now()->format("Y-m-d");
        $IdAnggota  = $req->input('id_anggota');
        // $IdPinjaman = $req->input('id_pinjaman');
        $IdPinjaman = $req->input('pinjaman');
        $Nominal    = str_replace(".","",$req->input('jumlah'));
        $Jangka     = $req->input('jangka');
        $Keperluan  = $req->input('keperluan');
        $Jaminan    = $req->input('jaminan')== null ? 'Tanpa Jaminan': $req->input('jaminan');
        $UserId = Auth::user()->id;
        $Jenis      = 'Pinjaman Tunai';

        if ($req->hasfile('filename')) {            
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$req->file('filename')->getClientOriginalName());
            $req->file('filename')->move(public_path('images/esign'), $filename);
        }


        $Pengajuan = PbyPengajuan::create([
            'id_anggota' => $IdAnggota,
            'id_pinjaman' =>$IdPinjaman,
            'no_pengajuan' => $NoPengajuan,
            'id_order' => 0,
            'jenis' => $Jenis,
            'no_rek' => '',
            'tanggal'=> $Tanggal,
            'nominal' => $Nominal,
            'jangka' => $Jangka,
            'keperluan' => $Keperluan,
            'jaminan' => $Jaminan, 
            'user_id' => $UserId,
            'foto_ttd' => $filename,
            'status_pengajuan' => "Menunggu Persetujuan HR",
        ]);

        //// Kirim Notif email ke pengurus
        $PbyNotif = PbyPengajuan::findorfail($Pengajuan->id);
        $Anggota    = MsAnggota::findorfail($PbyNotif->id_anggota);
        $urlAdmin    = env("APP_URL").'/admin/pengajuan/detail/'.$PbyNotif->id;
        $data = [
            'url' => $urlAdmin,
            'nama' => $Anggota->nama_anggota,
            'perusahaan' => $Anggota->Perusahaan->nama." - ".$Anggota->Department->nama,
            'status_karyawan' => $Anggota->status_karyawan,
            'no_telpon'=> $Anggota->no_telpon,
            'alamat' => $Anggota->alamat,
            'alamat_domisili' => $Anggota->alamat_domisili,
            'nominal' => $PbyNotif->nominal,
            'jangka' => $PbyNotif->jangka,
            'keperluan' =>$PbyNotif->keperluan,
            'jaminan' =>$PbyNotif->jaminan,
            'jenis'=>$PbyNotif->PbyMaster->nama,
            'body' => 'Permohonan Pengajuan Pinjaman'
            ];
        // dd($data);
        $EmailKetua = LibMaster::getPengurus('Ketua');
        $EmailSekr = LibMaster::getPengurus('Sekretaris');
        $EmailBend = LibMaster::getPengurus('Bendahara');
        
        if (companySetting("notif_email") == 1){
            Mail::to($EmailKetua)->cc([$EmailSekr, $EmailBend])->send(new PengajuanAnggotaMail($data));
        }     
        
        if(companySetting("is_notification") == 1){
            $Ket    = "Mengajukan Permohonan ".$PbyNotif->PbyMaster->nama;
            LibNotification::CreateNotif($Anggota->id, 0,0, intval($Pengajuan->id),'Pengajuan', $Ket,'Admin', 0);
        }        
        Session::flash('flash_message', 'Pengajuan pinjaman berhasil dikirim');
        return redirect('anggota/pengajuan');
    }

    public function kirimemail($id){
        
        Session::flash('flash_message', 'Pengajuan pinjaman berhasil dikirim');
        return redirect('anggota/pengajuan');
    }

    public function getJasa(Request $req)
    {
        $selectedValue = $req->input('selectedValue');
        $items = PbyMaster::where('id', $selectedValue)->get();

        return response()->json($items);
    }

    public function pengajuan_barang_index($id){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $PbyRekening    = PbyRekening::findorfail($id);
        // // dd($PbyRekening);

        // $IdRek  = $PbyRekening->id;
        // $Norek  = $PbyRekening->no_rek;

        // $PbyMutasi = DB::select("select * from pby_mutasi where no_rek='$Norek' order by tanggal, no_bukti ASC");
        // $JmlMutasi  = DB::select("select sum(angs_pokok) as angs_pokok, sum(angs_jasa) as angs_jasa from pby_mutasi where no_rek='$Norek' group by no_rek");

        // $JmlPokok = [];
        // $JmlJasa  = [];
        
        // foreach($JmlMutasi as $j){
        //     $JmlPokok   = $j->angs_pokok;
        //     $JmlJasa   = $j->angs_jasa;
        // }   
        $PbyRekening    = PbyRekening::findorfail($id);
        $PbyMutasi      = PbyMutasi::where('id_norek', $id)->get();
        // dd($PbyMutasi);
        $JdwAngs        = PbyJadwal::where('id_norek', $id)->get();

        return view('anggota.pinjaman.show', compact('PbyRekening', 'JdwAngs', 'PbyMutasi'));
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
        $IdPengajuan    = $req->input('id');

        $PbyPengajuan = PbyPengajuan::findorfail($IdPengajuan);
        
        $PbyPengajuan->delete();

        Session::flash('flash_message', 'Pengajuan pinjaman dibatalkan');
        return redirect('anggota/pengajuan');

    }
}
