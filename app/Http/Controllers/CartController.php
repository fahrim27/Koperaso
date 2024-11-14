<?php

namespace App\Http\Controllers;

use App\AgtCart;
use App\JbOrder;
use App\PbyPengajuan;
use App\JbOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\MsAnggota;
use App\MsProduk;
use Illuminate\Support\Carbon;
use App\Lib\LibTransaksi;
use App\Mail\AgtNewOrderMail;
use App\Mail\NotifOrderMail;
use App\Lib\LibMaster;
use Session;
use Mail;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UserId         = Auth::user()->id;
        $Anggota        = MsAnggota::where('user_id',$UserId)->get();
        $IdAnggota = [];
        foreach ($Anggota as $k) {
            $IdAnggota = $k->id;
        }
        $Cart = AgtCart::where('id_anggota',$IdAnggota)->where('is_checkout',0)->get();
        $JmlCart= $Cart->count();
        if ($JmlCart>0) {
            return view ('anggota.purchasing.cart.mycart',compact('Cart'));
        }else{
            return view ('anggota.purchasing.cart.empty_cart');
        }
    }

    public function addToCart($id)
    {
        $Product    = MsProduk::findorfail($id);
        $UserId         = Auth::user()->id;
        $Anggota        = MsAnggota::where('user_id',$UserId)->get();
        $IdAnggota = [];
        foreach ($Anggota as $k) {
            $IdAnggota = $k->id;
        }
        $Cart   = AgtCart::where('id_produk',$id)->where('id_anggota', $IdAnggota)->where('is_checkout',0)->count();
        if($Cart <=0) {
            AgtCart::create([
                'id_anggota' => $IdAnggota,
                'id_produk' => $id,
                'jumlah' => 1,
                'keterangan' =>''
            ]);            
        }else{            
            DB::update('update agt_cart set jumlah = jumlah+? where id_produk = ?', [1,$id]);            
        }
        // session()->put('cart', $Cart);
        $Msg='Barang berhasil ditambahkan ke keranjang.';
        Session::flash('flash_message','Barang berhasil ditambahkan ke keranjang.' );
        return redirect()->back();

    }

    public function checkout()
    {
        $UserId         = Auth::user()->id;
        $Anggota        = MsAnggota::where('user_id',$UserId)->get();
        $IdAnggota = [];
        foreach ($Anggota as $k) {
            $IdAnggota = $k->id;
        }
        $Cart   = AgtCart::where('id_anggota',$IdAnggota)->where('is_checkout',0)->get();

        return view('anggota.purchasing.cart.checkout', compact('Cart'));
    }

    public function pembayaran(Request $req){
        $this->validate($req,[
            'pembayaran' => 'required'
        ]);
        $Pembayaran     = $req->input('pembayaran');
        $Notes       = $req->input('notes');
        $UserId         = Auth::user()->id;
        $Tgl        = Carbon::now()->format("Ymd");
        $NoTrx      = LibTransaksi::NoOrder(substr($Tgl,-6));
        $Tanggal    = Carbon::now()->format("Y-m-d");
        $Anggota        = MsAnggota::where('user_id',$UserId)->get();
        $IdAnggota = [];
        foreach ($Anggota as $k) {
            $IdAnggota = $k->id;
        }

        $MyCart     =AgtCart::where('id_anggota',$IdAnggota)->where('is_checkout',0)->get();
        $TotalCart  = 0;
        foreach ($MyCart as $k) {
            $Harga  = $k->Produk->harga_jual;
            $Qty    = $k->jumlah;
            $TotalCart +=$Harga*$Qty;
        }
        switch ($Pembayaran) {
            case 'Tunai':
                $StsOrder   = "Menunggu Pembayaran";
                break;
            case 'Transfer Bank':
                $StsOrder   = "Menunggu Pembayaran";
                break;
            case 'Bayar Nanti (PG)':
                $StsOrder   = "Menunggu Konfirmasi";
                $Jangka     = 1;
                break;
            case 'Cicilan 3x':
                $StsOrder   = "Menunggu Konfirmasi";
                $Jangka     = 3;
                break;
            case 'Cicilan 6x':
                $StsOrder   = "Menunggu Konfirmasi";
                $Jangka     = 6;
                break;
            case 'Cicilan 12x':
                $StsOrder   = "Menunggu Konfirmasi";
                $Jangka     = 12;
                break;
            default:
                $Jangka     = 1;                
                $StsOrder   = "Menunggu Konfirmasi";
                break;
        }
        /// Masukin ke rekap Order Anggota
        $Order=JbOrder::create([
            'no_trx' => $NoTrx,
            'tanggal' => $Tanggal,
            'id_anggota' => $IdAnggota,
            'total' => $TotalCart,
            'diskon' => 0,
            'pembayaran' => $Pembayaran,
            'notes' => $Notes,
            'status_order' => $StsOrder
        ]);

        $IdOrder    = $Order->id;
        foreach ($MyCart as $k) {
            $IdProduk   = $k->id_produk;
            $Hpp        = $k->Produk->harga_beli;
            $Harga      = $k->Produk->harga_jual;
            $Qty        = $k->jumlah;

            JbOrderDetail::create([
                'id_order' => $IdOrder,
                'id_produk' => $IdProduk,
                'hpp' => $Hpp,
                'harga' => $Harga,
                'qty' => $Qty
            ]);
        }


        /// Kirim Notif Pesanan ke anggota
        $MsAnggota    = MsAnggota::findorfail($IdAnggota);
        $EmlAnggota = $MsAnggota->email;
        $urlAdmin    = env("APP_URL").'/anggota/purchasing';
        $data = [
            'url' => $urlAdmin,
            'nama_anggota' => $MsAnggota->nama_anggota,
            'perusahaan' => $MsAnggota->Perusahaan->nama,
        ];
        if(companySetting("notif_email") == 1){        
            Mail::to($EmlAnggota)->send(new AgtNewOrderMail($data));
        }
        
        $EmailKetua = LibMaster::getPengurus('Ketua');
        $EmailSekr = LibMaster::getPengurus('Sekretaris');
        $EmailBend = LibMaster::getPengurus('Bendahara');
        $EmailUjb = LibMaster::getPengurus('Jual Beli');


        /// Kirim Email Pesanan ke Pengurus        
        $OrderDetail = JbOrderDetail::join('ms_produk', 'ms_produk.id', '=', 'jb_order_detail.id_produk')->join('jb_order', 'jb_order.id', '=','jb_order_detail.id_order')->where('jb_order_detail.id_order',$IdOrder)->get([ 'ms_produk.nama_barang', 'jb_order_detail.harga', 'jb_order_detail.qty']);
        
        if(companySetting("notif_email") == 1){
            Mail::to($EmailKetua)->cc([$EmailSekr, $EmailBend, $EmailUjb])->send(new NotifOrderMail($data, $OrderDetail));
        }

        // foreach ($OrderDetail as $d) {
        //     # code...
        // }

        /// Jika bayar nya Hutang (PG) atau Cicilan amsuk ke Pengajuan USP
        // if ($StsOrder == "Menunggu Konfirmasi")
        // {
        //     $IdPinjaman = 4;
        //     $Jenis      = 'Cicilan Barang';
        //     $Keperluan  = 'Pembelian / Cicilan Barang';
        //     PbyPengajuan::create([
        //         'id_anggota' => $IdAnggota,
        //         'id_pinjaman' =>$IdPinjaman,
        //         'no_pengajuan' => $NoPengajuan,
        //         'id_order' => $IdOrder,
        //         'jenis' => $Jenis,
        //         'no_rek' => '',
        //         'tanggal'=> $Tanggal,
        //         'nominal' => $TotalCart,
        //         'jangka' => $Jangka,
        //         'keperluan' => $Keperluan,
        //         'jaminan' => 'Tanpa Jaminan', 
        //         'user_id'=> $UserId,
        //         'status_pengajuan' => "Menunggu Persetujuan HR",
        //     ]);
        // }

        /// Tandai Cart
        DB::update("UPDATE agt_cart SET tgl_checkout=?, is_checkout=?",[$Tanggal,1]);

        Session::flash('flash_message', 'Pesanan telah dibuat');
        return redirect('anggota/purchasing');

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
    public function update(Request $req)
    {

        $cartId = $req->input('cart_id');
        $quantity = $req->input('quantity', 1);

        $Cart = AgtCart::findorfail($cartId);

        // Update quantity produk dalam cart
        $Cart->update([
            'jumlah' => $quantity,
        ]);

        return response()->json(['message' => 'Keranjang berhasil diupdate.']);
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

    public function remove(Request $req)
    {
        $id     = $req->input('id');

        $MyCart = AgtCart::findorfail($id);
        $MyCart->delete();

        Session::flash('flash_message', 'Data barang telah dihapus');
        return redirect('anggota/purchasing/mycart');

    }
}
