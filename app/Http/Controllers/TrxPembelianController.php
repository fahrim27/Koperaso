<?php

namespace App\Http\Controllers;

use App\JbMutasiStok;
use App\Lib\LibTransaksi;
use App\Lib\CreateJurnal;
use App\Lib\LibAkun;
use App\MsProduk;
use App\MsSuplier;
use App\TmpCart;
use Illuminate\Http\Request;
use App\TrxPembelian;
use App\TrxPembelianDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class TrxPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TrxBeli    = TrxPembelian::all();
        

        return view('admin.trx_pembelian.index', compact('TrxBeli'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MsSuplier  = MsSuplier::all();
        $UserId     = Auth::user()->id;
        $TmpCart    = TmpCart::where('id_user',$UserId)->get();
        $MsProduk   = MsProduk::all();
        return view('admin.trx_pembelian.create', compact('MsSuplier',  'TmpCart', 'MsProduk'));
    }

    public function addToCart(Request $req)
    {
        $id= $req->input('id_produk');
        $qty = $req->input('qty');
        $UserId         = Auth::user()->id;
        if ($req->get('btnSubmit') == "additem"){
            $this->validate($req, [
                'id_produk' => 'required'
            ]);
            $Product    = MsProduk::findorfail($id);
            $Cart   = TmpCart::where('id_produk',$id)->where('id_user', $UserId)->count();
            if($Cart <=0) {
                TmpCart::create([
                    'id_user' => $UserId,
                    'id_produk' => $id,
                    'jumlah' => $qty,
                ]);            
            }else{            
                DB::update('update tmp_cart set jumlah = jumlah+? where id_produk = ?', [1,$id]);            
            }
            return redirect()->back()->withInput();;
        }else{
            $this->validate($req, [
                'id_suplier' => 'required',
                'tanggal' =>'required'
            ]);            
            $Tgl   = $req->input('tgl_mulai');
            $Suplier=$req->input('id_suplier');
            $Pembayaran  = $req->input('pembayaran');
            $Ket    = $req->input('keterangan');

            $TmpCart    = TmpCart::where('id_user', $UserId)->get();
            
        }
    }

    public function pembayaran()
    {
        $UserId         = Auth::user()->id;
        $TmpCart    = TmpCart::where('id_user', $UserId)->get();
        $MsSuplier  = MsSuplier::all();


        return view('admin.trx_pembelian.checkout_pembelian', compact('TmpCart', 'MsSuplier'));
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
            'id_suplier' => 'required',
            'pembayaran' => 'required'
        ]);

        $Tgl    = $req->input('tanggal');
        $IdSuplier    = $req->input('id_suplier');
        $Suplier      = MsSuplier::findorfail($IdSuplier);
        $Pembayaran = $req->input('pembayaran');
        $Ket        = $req->input('keterangan') == '' ? 'Pembelian Barang dari '.$Suplier->nama_suplier : $req->input('keterangan');
        $Total      = $req->input('total');
        $UserId         = Auth::user()->id;


        $Pembelian = TrxPembelian::create([
            'tanggal' => $Tgl,
            'id_suplier' => $IdSuplier,
            'pembayaran' => $Pembayaran,
            'keterangan' => $Ket,
            'subtotal' => $Total,
            'total' => $Total,
            'status' => 'Menunggu',
            'id_user' => $UserId
        ]);

        $idBeli = $Pembelian->id;
        $TmpCart = TmpCart::where('id_user', $UserId)->get();
        foreach ($TmpCart as $s) {
            $IdProduk   = $s->id_produk;
            $HrgBeli    = $s->Produk->harga_beli;
            $qty        = $s->jumlah;
            $subtotal   = $HrgBeli*$qty;

            /// Masukkan Detail Pembelian
            TrxPembelianDetail::create([
                'id_pembelian' => $idBeli,
                'id_produk' => $IdProduk,
                'harga_beli' => $HrgBeli,
                'qty' => $qty,
                'subtotal' => $subtotal
            ]);

            /// Masukkan di pencatatan Stok
            // JbMutasiStok::create([
            //     'id_pembelian' => $idBeli,
            //     'id_produk' => $IdProduk,
            //     'tanggal' => $Tgl,
            //     'keterangan' => $Ket,
            //     'masuk' => $qty,
            //     'keluar'=>0,
            //     'user_id' => $UserId
            // ]);

            // /// Update Stok barang
            // DB::update("UPDATE ms_produk SET stok=stok+? WHERE id=?",[$qty,$IdProduk]);
        }

        // Hapus Cart
        DB::delete("DELETE FROM tmp_cart WHERE id_user=?",[$UserId]);

        Session::flash('flash_message', 'Pembelian barang bersahil disimpan');
        return redirect('admin/pembelian');
    }

    public function approve_pembelian(Request $req)
    {
        $id = $req->input('id');
        $UserId         = Auth::user()->id;

        $TrxBeli = TrxPembelian::findorfail($id);
        $Tgl     = $TrxBeli->tanggal;
        $Ket     = $TrxBeli->keterangan;
        $Total   = $TrxBeli->total;
        $TrxBeli->update([
            'status' => 'Disetujui'
        ]);

        $TrxBeliDetail = TrxPembelianDetail::where('id_pembelian', $id)->get();
        foreach ($TrxBeliDetail as $s) {
            $IdProduk   = $s->id_produk;
            $HrgBeli    = $s->harga_beli;
            $qty        = $s->qty;
            $subtotal   = $s->subtotal;

            //// Masukkan di pencatatan Stok
            JbMutasiStok::create([
                'id_pembelian' => $id,
                'id_produk' => $IdProduk,
                'tanggal' => $Tgl,
                'keterangan' => $Ket,
                'masuk' => $qty,
                'keluar'=>0,
                'user_id' => $UserId
            ]);

            /// Update Stok barang
            DB::update("UPDATE ms_produk SET stok=stok+? WHERE id=?",[$qty,$IdProduk]);
        }
        $NoBukti    = LibTransaksi::NoBukti(substr($Tgl,-6));
        $AkunKas    = LibAkun::AkunKAS();
        $AkunPersediaan = LibAkun::AkunPersediaan();
        $AktJnsMutasi = "Pembelian";

        CreateJurnal::AktMutasi($NoBukti, $AkunPersediaan, $Total, 'debet', $Ket, $AktJnsMutasi, $Tgl);
        CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Total, 'kredit', $Ket, $AktJnsMutasi, $Tgl);
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

    public function increaseQty($id)
    {
        $qty =1;
        DB::update("UPDATE tmp_cart SET jumlah=jumlah+? WHERE id=?",[$qty,$id]);
        return redirect()->back()->withInput();
    }

    public function decreaseQty($id)
    {
        $qty =1;
        DB::update("UPDATE tmp_cart SET jumlah=jumlah-? WHERE id=?",[$qty,$id]);
        return redirect()->back()->withInput();
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

        DB::update("UPDATE tmp_cart SET jumlah=jumlah+? WHERE id=?",[$quantity,$cartId]);


        // $Cart = TmpCart::findorfail($cartId);

        // // Update quantity produk dalam cart
        // $Cart->update([
        //     'jumlah' => $quantity
        // ]);

        return response()->json(['message' => 'Keranjang berhasil diupdate.']);
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

        $TrxBeli = TrxPembelian::findorfail($id);
        $TrxBeli->delete();
        // $TrxBeliDetail = TrxPembelianDetail::where('id_pembelian', $id)->get();
        // foreach ($TrxBeliDetail as $k) {
        //     $IdProduk = $k->id_produk;
        //     $qty    = $k->qty;
        //     DB::update("UPDATE ms_produk SET stok=stok-? WHERE id=?",[$qty, $IdProduk]);
        // }

        DB::delete("DELETE FROM trx_pembelian_detail WHERE id_pembelian=?",[$id]);
        // DB::delete("DELETE FROM jb_mutasi_stok WHERE id_pembelian=?",[$id]);
        
    }
}
