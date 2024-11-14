<?php

namespace App\Http\Controllers;

use App\JbOrder;
use App\AktSetting;
use App\ChartAccount;
use App\JbOrderDetail;
use App\Lib\LibTransaksi;
use App\Mail\AgtApproveHrMail;
use App\Mail\AgtApprovePengajuanMail;
use App\Mail\AgtRejectPengajuanMail;
use App\PbyPengajuan;
use Illuminate\Http\Request;
use App\MsAnggota;
use Illuminate\Support\Carbon;
use App\PbyMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;
use Mail;

class PbyPengajuanController extends Controller
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
        $RoleDepart = userHelpers('department');        
        $AllPengajuan   = PbyPengajuan::orderBy('id','DESC')->get();
        $ApproveHr      = PbyPengajuan::where('approve_by_hr',1)->get();
        $ApproveCfo     = PbyPengajuan::where('approve_by_cfo',1)->get();
        $Reject         = PbyPengajuan::where('status_pengajuan','Tidak Disetujui')->orWhere('status_pengajuan','Tidak Disetujui HR')->orWhere('status_pengajuan','Tidak Disetujui CFO')->orWhere('status_pengajuan','Pencairan DIbatalkan')->get();

        return view('admin.pby_pengajuan.index', compact('AllPengajuan', 'ApproveHr', 'ApproveCfo','Reject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Anggota    = MsAnggota::where('status_keanggotaan', 'Aktif')->get();
        $PbyMaster  = PbyMaster::where('kode', '50')->get();

        return view('admin.pby_pengajuan.create', compact('Anggota', 'PbyMaster'));
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
            'id_anggota' => 'required',
            'id_pinjaman' => 'required',
            'jumlah' => 'required',
            'jangka' => 'required',
            'keperluan' => 'required',
            'jaminan' => 'required',
        ]);
        $Tgl        = Carbon::now()->format("Ymd");
        $NoPengajuan = LibTransaksi::NoPengajuan(substr($Tgl,-6));
        $Tanggal    = Carbon::now()->format("Y-m-d");
        $IdAnggota  = $req->input('id_anggota');
        $IdPinjaman = $req->input('id_pinjaman');
        $Nominal    = str_replace(".","",$req->input('jumlah'));
        $Jangka     = $req->input('jangka');
        $Keperluan  = $req->input('keperluan');
        $Jaminan    = $req->input('jaminan');
        $UserId     = Auth::user()->id;
        $Jenis      = "Pinjaman Tunai";

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
            'user_id'=> $UserId,
            'status_pengajuan' => "Menunggu Persetujuan HR",
        ]);
        Session::flash('flash_message', 'Pengajuan pinjaman telah dibuat');
        return redirect('admin/pengajuan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $PbyPengajuan = PbyPengajuan::findorfail($id);
        $OrderId      = $PbyPengajuan->id_order;
        if ($OrderId<>0){
            $Order      = JbOrder::findorfail($OrderId);
            $DetailOrder = JbOrderDetail::where('id_order',$OrderId)->get();
        }else{
            $Order      = [];
            $DetailOrder = [];
        }
        $Akun = ChartAccount::orderby('kde_akun','ASC')->get();
        $AktSetting  = AktSetting::first();

        $AkunKas        = $AktSetting->akun_kas;
        return view('admin.pby_pengajuan.show', compact('PbyPengajuan', 'Order', 'DetailOrder', 'Akun', 'AkunKas'));
    }

    public function download($id)
    {
        $PbyPengajuan  = PbyPengajuan::findorfail($id);

        $Nama       = $PbyPengajuan->Anggota->nama_anggota;
        return view('admin.pby_pengajuan.print', compact('PbyPengajuan'));

        // $pdf = PDF::loadview('admin.pby_pengajuan.print',['PbyPengajuan'=>$PbyPengajuan]);
    	// return $pdf->download('Formulir-Pengajuan-Pinjaman-'.$Nama.'.pdf');        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $PbyPengajuan = PbyPengajuan::findorfail($id);
        $OrderId      = $PbyPengajuan->id_order;
        if ($OrderId<>0){
            $Order      = JbOrder::findorfail($OrderId);
            $DetailOrder = JbOrderDetail::where('id_order',$OrderId)->get();
        }else{
            $Order      = [];
            $DetailOrder = [];
        }

        return view('admin.pby_pengajuan.edit', compact('PbyPengajuan', 'Order', 'DetailOrder'));
    }

    public function update_pengajuan(Request $req)
    {
        $this->validate($req,[
            'nominal' =>'required',
            'jangka' =>'required'
        ]);
        $id = $req->input('id');
        $Nominal    = str_replace(".","",$req->input('nominal'));
        $Jangka     = $req->input('jangka');

        $PbyPengajuan = PbyPengajuan::findorfail($id);
        $PbyPengajuan->update([
            'nominal' =>$Nominal,
            'jangka' => $Jangka,
            'keterangan' => $req->input('keterangan')
        ]);

        Session::flash('flash_message', 'Pengajuan pinjaman telah diperbarui');
        return redirect('admin/pengajuan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $IdPengajuan    = $req->input('id');
        $Approve        = $req->input('sts_pengajuan');
        $RoleDepart     = userHelpers('department');
        $ApproveHr =0;
        $ApproveCfo =0;
        // dd($req);

        if ($Approve=="Disetujui") {
            switch ($RoleDepart) {
                case 'HR':
                    $StsPengajuan = 'Menunggu Persetujuan CFO';
                    $ApproveHr =1;
                    break;
                case 'CFO':
                    $StsPengajuan = 'Menunggu Pencairan';
                    $ApproveHr =1;
                    $ApproveCfo =1;
                    break;  
                case 'ADMIN':              
                    $GetPengajuan   = PbyPengajuan::findorfail($IdPengajuan);

                    if ($GetPengajuan->status_pengajuan=="Menunggu Persetujuan HR") {
                        $StsPengajuan = 'Menunggu Persetujuan CFO';
                        $ApproveHr =1;
                    }else{
                        $StsPengajuan = 'Menunggu Pencairan';
                        $ApproveHr =1;
                        $ApproveCfo =1;
                    }
                    break;
                default:                
                    # code...
                    break;
            }
        }else{
            switch ($RoleDepart) {
                case 'HR':
                    $StsPengajuan = 'Tidak Disetujui HR';
                    $ApproveHr =0;
                    break;
                case 'CFO':
                    $StsPengajuan = 'Tidak Disetujui CFO';
                    $ApproveCfo =0;
                    break;
                case 'ADMIN':              
                    $GetPengajuan   = PbyPengajuan::findorfail($IdPengajuan);

                    if ($GetPengajuan->status_pengajuan=="Menunggu Persetujuan HR") {
                        $StsPengajuan = 'Tidak Disetujui HR';
                        $ApproveHr =0;
                    }else{
                        $StsPengajuan = 'Tidak Disetujui CFO';
                        $ApproveCfo =0;
                    }
                    break;
                case 'USP':
                    $StsPengajuan = 'Pencairan Dibatalkan';
                    $ApproveHr =0;
                    $ApproveCfo =0;
                    break;             
                default:
                    $StsPengajuan = 'Tidak Disetujui';
                    $ApproveHr =0;
                    $ApproveCfo =0;
                    break;
            }
        }
        

        $Pengajuan  = PbyPengajuan::findorfail($IdPengajuan);
        $IdPinjaman = $Pengajuan->id_pinjaman;
        $IdAnggota  = $Pengajuan->id_anggota;
        $Tanggal    = Carbon::now()->format("Y-m-d");
        $Ket        = $req->input('keterangan');

        $Pengajuan->update([
            'status_pengajuan' => $StsPengajuan, 
            'tgl_ubah' => $Tanggal,
            'approve_by_hr' => $ApproveHr,
            'approve_by_cfo' => $ApproveCfo,
            'keterangan' => ($Ket==null ? '' : $Ket)
        ]);

        $PbyMaster = PbyMaster::findorfail($IdPinjaman);
        $JnsPby     = $PbyMaster->jenis_pinjaman;
        if ($JnsPby == "Tunai"){            
            if ($StsPengajuan=="Menunggu Persetujuan CFO")
            {
                $MsAnggota    = MsAnggota::findorfail($IdAnggota);
                $EmlAnggota = $MsAnggota->email;
                $urlAdmin    = env("APP_URL").'/login';
                $data = [
                    'url' => $urlAdmin,
                    'nama_anggota' => $MsAnggota->nama_anggota,
                ];
                if(companySetting("notif_email") == 1){
                    Mail::to($EmlAnggota)->send(new AgtApproveHrMail($data));  
                }          
            }

            if ($StsPengajuan=="Menunggu Pencairan")
            {
                $MsAnggota    = MsAnggota::findorfail($IdAnggota);
                $EmlAnggota = $MsAnggota->email;
                $urlAdmin    = env("APP_URL").'/login';
                $data = [
                    'url' => $urlAdmin,
                    'nama_anggota' => $MsAnggota->nama_anggota,
                ];
                if(companySetting("notif_email") == 1){
                    Mail::to($EmlAnggota)->send(new AgtApprovePengajuanMail($data));            
                }
            }

            if ($Approve!="Disetujui")
            {
                $MsAnggota    = MsAnggota::findorfail($IdAnggota);
                $EmlAnggota = $MsAnggota->email;
                $urlAdmin    = env("APP_URL").'/login';
                $data = [
                    'url' => $urlAdmin,
                    'nama_anggota' => $MsAnggota->nama_anggota,
                ];
                if(companySetting("notif_email") == 1){
                    Mail::to($EmlAnggota)->send(new AgtRejectPengajuanMail($data)); 
                }
            }
        }

        Session::flash('flash_message', 'Status pengajuan telah diperbarui');
        return redirect('admin/pengajuan');
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
