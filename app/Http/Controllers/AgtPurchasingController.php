<?php

namespace App\Http\Controllers;

use App\JbOrder;
use App\JbOrderDetail;
use App\MsProduk;
use Illuminate\Http\Request;
use App\MsAnggota;
use App\PbyMaster;
use App\PbyPengajuan;
use App\ShuJasaAgt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Lib\LibTransaksi;
use Illuminate\Support\Facades\DB;
use Session;

class AgtPurchasingController extends Controller
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
            $IdAnggota  = $a->id;           
            $NamaAgt    = $a->nama_anggota;
            $Perush     = $a->Perusahaan->nama;
        }

        $JbOrderAll    = JbOrder::where('id_anggota', $IdAnggota)->get();
        $JbOrderWait   = 
        DB::select("SELECT * FROM jb_order WHERE id_anggota=? AND (status_order=? OR status_order=?)", [$IdAnggota,'Menunggu Konfirmasi','Menunggu Pembayaran']);
        
        // $JbOrderWait   = JbOrder::where('id_anggota', $IdAnggota)->Where('status_order','Menunggu Konfirmasi')->orWhere('status_order','Menunggu Pembayaran')->get();

        $JbOrderProses   = JbOrder::where('id_anggota', $IdAnggota)->where('status_order','Diproses')->get();
        
        
        $JbOrderSelesai   = JbOrder::where('id_anggota', $IdAnggota)->where('status_order','Selesai')->orWhere('status_order','Siap Diambil')->get();

        $JbOrderBatal   = JbOrder::where('id_anggota', $IdAnggota)->where('status_order','Dibatalkan')->get();

        return view('anggota.purchasing.index', compact('JbOrderAll', 'JbOrderWait', 'JbOrderProses', 'JbOrderSelesai', 'JbOrderBatal', 'IdAnggota','NamaAgt', 'Perush',));
    }

    public function catalog()
    {
        $Produk     =  MsProduk::orderBy('id')->paginate(30);
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.all', compact('Produk', 'searchQuery'));
    }

    public function catalog_filter(Request $req)
    {
        $searchQuery = $req->input('q');
        $Produk     =  MsProduk::where('nama_barang', 'like', '%' . $searchQuery . '%')->paginate(30);
        return view('anggota.purchasing.catalog_filter.all', compact('Produk', 'searchQuery'));
    }

    public function catalog_bhnpokok()
    {
        $id=1;
        $Produk     =  MsProduk::orderBy('id')->where('id_kategori',$id)->paginate(30);
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.bahan_pokok', compact('Produk', 'searchQuery'));
    }
    public function catalog_bhnpokok_filter(Request $req)
    {
        $id=1;
        $searchQuery = $req->input('q');
        $Produk     =  MsProduk::where('id_kategori',$id)->where('nama_barang', 'like', '%' . $searchQuery . '%')->get();
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.bahan_pokok', compact('Produk', 'searchQuery'));
    }

    public function catalog_elektronik()
    {
        $id=2;
        $Produk     =  MsProduk::orderBy('id')->where('id_kategori',$id)->paginate(30);
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.elektronik', compact('Produk', 'searchQuery'));
    }
    public function catalog_elektronik_filter(Request $req)
    {
        $id=2;
        $searchQuery = $req->input('q');
        $Produk     =  MsProduk::where('id_kategori',$id)->where('nama_barang', 'like', '%' . $searchQuery . '%')->get();
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.elektronik', compact('Produk', 'searchQuery'));
    }

    public function catalog_furniture()
    {
        $id=3;
        $Produk     =  MsProduk::orderBy('id')->where('id_kategori',$id)->paginate(30);
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.furniture', compact('Produk', 'searchQuery'));
    }
    public function catalog_furniture_filter(Request $req)
    {
        $id=3;
        $searchQuery = $req->input('q');
        $Produk     =  MsProduk::where('id_kategori',$id)->where('nama_barang', 'like', '%' . $searchQuery . '%')->get();
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.furniture', compact('Produk', 'searchQuery'));
    }

    public function catalog_sepeda_motor()
    {
        $id=4;
        $Produk     =  MsProduk::orderBy('id')->where('id_kategori',$id)->paginate(30);
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.sepeda_motor', compact('Produk', 'searchQuery'));
    }
    public function catalog_sepeda_motor_filter(Request $req)
    {
        $id=4;
        $searchQuery = $req->input('q');
        $Produk     =  MsProduk::where('id_kategori',$id)->where('nama_barang', 'like', '%' . $searchQuery . '%')->get();
        $searchQuery = '';
        return view('anggota.purchasing.catalog_filter.sepeda_motor', compact('Produk', 'searchQuery'));
    }

    public function catalog_all_filter(Request $req)
    {

        $Produk     =  MsProduk::orderBy('id')->get();
        return view('anggota.purchasing.catalog_filter.all', compact('Produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
        $PbyMaster  = PbyMaster::where('kode', '51')->get();
        $IdPinjaman     = [];
        foreach($PbyMaster as $p){
            $IdPinjaman = $p->id;           
        }
        $Produk = MsProduk::findorfail($id);

        return view('anggota.purchasing.create', compact('Produk', 'IdPinjaman', 'IdAnggota','NamaAgt', 'Perush', 'PbyMaster'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $Tgl        = Carbon::now()->format("Ymd");
        $NoTrx      = LibTransaksi::NoOrder(substr($Tgl,-6));
        $NoPengajuan = LibTransaksi::NoPengajuan(substr($Tgl,-6));
        $Tanggal    = Carbon::now()->format("Y-m-d");
        $IdAnggota  = $req->input('id_anggota');
        $IdPinjaman = $req->input('id_pinjaman');
        $IdBarang   = $req->input('id_barang');
        $NamaBarang = $req->input('namabarang');
        $Nominal    = $req->input('harga');
        $Pembayaran = $req->input('pembayaran') == 'cicilan' ? 'Cicilan' : 'Bayar Penuh';
        $Jangka     = ($Pembayaran=="Cicilan") ? 12 : 0;
        $UserId     = Auth::user()->id;
        $Jenis      = 'Cicilan Barang';
        $Keperluan  = 'Cicilan '.$NamaBarang;
        $Notes      = $req->input('notes');
        $Qty        = $req->input('qty');

        $MsBarang   = MsProduk::findorfail($IdBarang);
        $Hpp = $MsBarang->harga_beli;

        $Order  = JbOrder::create([
            'no_trx' => $NoTrx,
            'tanggal' => $Tanggal,
            'id_anggota' => $IdAnggota,
            'id_produk' => $IdBarang,
            'hpp' =>$Hpp,
            'harga' => $Nominal,
            'jangka' => $Jangka,
            'pembayaran' => $Pembayaran,
            'noted' => $Notes,
            'qty' => $Qty,
            'status_order' => 'Menunggu Konfirmasi' 
        ]);

        if ($Pembayaran == 'Cicilan'){
            $Pengajuan = PbyPengajuan::create([
                'id_anggota' => $IdAnggota,
                'id_pinjaman' =>$IdPinjaman,
                'no_pengajuan' => $NoPengajuan,
                'id_order' => $Order->id,
                'jenis' => $Jenis,
                'no_rek' => '',
                'tanggal'=> $Tanggal,
                'nominal' => $Nominal,
                'jangka' => $Jangka,
                'keperluan' => $Keperluan,
                'jaminan' => 'Tanpa Jaminan', 
                'user_id'=> $UserId,
                'status_pengajuan' => "Menunggu Persetujuan HR",
            ]);
        }
        // else{
        //     /// Masukkan ke transaksi JASA utk perhitungan SHU
        //     ShuJasaAgt::create([
        //         'id_anggota' => $IdAnggota,
        //         'no_trx' => $NoTrx,
        //         'tanggal' => $Tanggal,
        //         'hpp' => $Hpp,
        //         'harga_jual' => $Nominal,
        //         'nominal' => $Nominal-$Hpp
        //     ]);
        // }
        
        Session::flash('flash_message', 'Pesanan telah dibuat');
        return redirect('anggota/purchasing');
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

        return view('anggota.purchasing.show', compact('JbOrder', 'DetailOrder'));
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
