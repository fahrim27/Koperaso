<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JbOrder;
use App\JbOrderDetail;
use App\ShuJasaAgt;
use Carbon\Carbon;
use App\Lib\CreateJurnal;
use App\Lib\LibAkun;
use App\MsAnggota;
use App\PbyPengajuan;
use App\Lib\LibTransaksi;
use App\Mail\AgtProsesOrderMail;
use App\Mail\AgtSelesaiOrderMail;
use App\Mail\AgtSiapAmbilOrderMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\NotifOrderMail;
use Session;
use Mail;

class PurchasingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $JbOrderAll    = JbOrder::all();
        $JbOrderWait   = JbOrder::where('status_order','Menunggu Konfirmasi')->orWhere('status_order','Menunggu Pembayaran')->get();

        $JbOrderProses   = JbOrder::where('status_order','Diproses')->get();
        
        $JbOrderSelesai   = JbOrder::where('status_order','Selesai')->orWhere('status_order','Siap Diambil')->get();

        $JbOrderBatal   = JbOrder::where('status_order','Dibatalkan')->get();

        return view('admin.purchasing.index', compact('JbOrderAll', 'JbOrderWait', 'JbOrderProses', 'JbOrderSelesai', 'JbOrderBatal'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $JbOrder = JbOrder::findorfail($id);
        $DetailOrder = JbOrderDetail::where('id_order',$id)->get();

        return view('admin.purchasing.show', compact('JbOrder', 'DetailOrder'));
    }

    public function cetak($id)
    {
        $JbOrder = JbOrder::findorfail($id);
        $DetailOrder = JbOrderDetail::where('id_order',$id)->get();

        return view('admin.purchasing.print', compact('JbOrder', 'DetailOrder'));
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
    public function update(Request $req)
    {
        $IdOrder        = $req->input('id');
        $StsPengajuan   = $req->input('sts_pengajuan');
        $KetBatal       = $req->input('ket_batal');
        $Tgl            = Carbon::now()->format('Y-m-d');
        $Order          = JbOrder::findorfail($IdOrder);
        $Pembayaran     = $Order->pembayaran;
        $IdAnggota      = $Order->id_anggota;
        $NoPengajuan    = $Order->no_pengajuan;
        $UserId         = Auth::user()->id;
        $Tgl            = Carbon::now()->format("Ymd");
        $NoPengajuan    = LibTransaksi::NoPengajuan(substr($Tgl,-6));
        $Tanggal        = Carbon::now()->format("Y-m-d");
        $TotalCart      = $Order->total;
        switch ($Pembayaran) {
            case 'Bayar Nanti (PG)':
                $Jangka     = 1;
                break;
            case 'Cicilan 3x':
                $Jangka     = 3;
                break;
            case 'Cicilan 6x':
                $Jangka     = 6;
                break;
            case 'Cicilan 12x':
                $Jangka     = 12;
                break;
            default:
                $Jangka     = 1;                
                break;
        }
        ///// Perbarui Status Pesanan
        $Order->update([
            'status_order' => $StsPengajuan, 
            'ket_batal' => ($KetBatal==null ? '' : $KetBatal)
        ]);

        ///// Masukan sebagai pengajuan jika status di proses
        if ($StsPengajuan=="Diproses"){
            if(($Pembayaran=="Bayar Nanti (PG)") ||($Pembayaran=="Cicilan 3x") || ($Pembayaran=="Cicilan 6x") || ($Pembayaran=="Cicilan 12x"))
            {
                $IdPinjaman = 4;
                $Jenis      = 'Cicilan Barang';
                $Keperluan  = 'Pembelian / Cicilan Barang';
                PbyPengajuan::create([
                    'id_anggota' => $IdAnggota,
                    'id_pinjaman' =>$IdPinjaman,
                    'no_pengajuan' => $NoPengajuan,
                    'id_order' => $IdOrder,
                    'jenis' => $Jenis,
                    'no_rek' => '',
                    'tanggal'=> $Tanggal,
                    'nominal' => $TotalCart,
                    'jangka' => $Jangka,
                    'keperluan' => $Keperluan,
                    'jaminan' => 'Tanpa Jaminan', 
                    'user_id'=> $UserId,
                    'status_pengajuan' => "Menunggu Persetujuan HR",
                ]);
            }
        
            $MsAnggota    = MsAnggota::findorfail($IdAnggota);
            $EmlAnggota = $MsAnggota->email;
            $urlAdmin    = env("APP_URL").'/anggota/purchasing';
            $data = [
                'url' => $urlAdmin,
                'nama_anggota' => $MsAnggota->nama_anggota,
            ];
            if(companySetting("notif_email") == 1){
                Mail::to($EmlAnggota)->send(new AgtProsesOrderMail($data));
            }
        }

        if ($StsPengajuan=="Siap Diambil"){
            $MsAnggota    = MsAnggota::findorfail($IdAnggota);
            $EmlAnggota = $MsAnggota->email;
            $urlAdmin    = env("APP_URL").'/anggota/purchasing';
            $data = [
                'url' => $urlAdmin,
                'nama_anggota' => $MsAnggota->nama_anggota,
            ];
            if(companySetting("notif_email") == 1){
                Mail::to($EmlAnggota)->send(new AgtSiapAmbilOrderMail($data));
            }
        }

        /// JIka transaksi selesai hitung keuntungan koperasi
        if ($StsPengajuan=="Selesai"){           
            $IdAgt  = $Order->id_anggota;
            $NoTrx  = $Order->no_trx;
            
            $OrderDetail = DB::select("SELECT sum(harga*qty) as jmlHarga, sum(hpp*qty) as jmlHpp FROM jb_order_detail WHERE id_order=?", [$IdOrder]);
            $JmlHarga   = [];
            $JmlHpp   = [];
            foreach ($OrderDetail as $jAgt) {                
                $JmlHarga   = $jAgt->jmlHarga;
                $JmlHpp   = $jAgt->jmlHpp;
            }            
            $JasaAgt    = $JmlHarga-$JmlHpp;

            ShuJasaAgt::create([
                'id_anggota' => $IdAgt,
                'tanggal' => $Tgl,
                'no_trx' => $NoTrx,
                'hpp' => $JmlHpp,
                'harga' => $JmlHarga,
                'nominal' => $JasaAgt
            ]);
            $Keterangan = "Pendptn Penjualan Barang";
            $JnsMutasi  = "Penjualan";
            $AkunKas    = LibAkun::AkunKAS();
            $KdeAkun    = '00140108';


            /// Kas Masuk
            CreateJurnal::AktMutasi($NoTrx, $AkunKas, $JasaAgt, 'debet', $Keterangan, $JnsMutasi, $Tanggal);
            CreateJurnal::AktMutasi($NoTrx, $KdeAkun, $JasaAgt, 'kredit', $Keterangan, $JnsMutasi, $Tanggal);

            /// Kirim notifikasi Email
            $MsAnggota    = MsAnggota::findorfail($IdAnggota);
            $EmlAnggota = $MsAnggota->email;
            $urlAdmin    = env("APP_URL").'/anggota/purchasing';
            $data = [
                'url' => $urlAdmin,
                'nama_anggota' => $MsAnggota->nama_anggota,
            ];
            if(companySetting("notif_email") == 1){
                Mail::to($EmlAnggota)->send(new AgtSelesaiOrderMail($data));
            }
            
            Session::flash('flash_message', 'Pesanan telah selesai');
            return redirect('admin/purchasing');
        }

        Session::flash('flash_message', 'Status Pesanan Telah Diperbarui');
        return redirect('admin/purchasing');
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
