<?php

namespace App\Http\Controllers;

use App\JbMutasiStok;
use App\JbOrderDetail;
use App\MsKategori;
use App\MsProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ProdukController extends Controller
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
        $Produk = MsProduk::all();
        return view('admin.ms_produk.index', compact('Produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Kategori   = MsKategori::all();
        // $Cicilan = "0";
        // $BayarPenuh = "0";
        return view('admin.ms_produk.create', compact('Kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'id_kategori' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga_beli' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,jpeg,png|max:2000' 
        ]);

        $IdKategori = $req->input('id_kategori');
        $Nama       = $req->input('nama');
        $Deskripsi  = $req->input('deskripsi');
        $HargaBeli  = str_replace(".","",$req->input('harga_beli'));
        $Harga    = str_replace(".","",$req->input('harga'));
        $Status     = $req->input('status');
        $BayarPenuh    = $req->has('is_bayarpenuh') ? "Y" : "N";
        $Cicilan       = $req->has('is_cicilan') ? "Y" : "N";
        $Estimasi      = $req->input('estimasi');
        $Stok           = $req->input('stok');

        if ($req->hasfile('filename')) {            
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$req->file('filename')->getClientOriginalName());
            $req->file('filename')->move(public_path('images'), $filename);
        }

        MsProduk::create([
            'id_kategori' => $IdKategori,
            'nama_barang' => $Nama,
            'deskripsi' => $Deskripsi,
            'harga_beli' => $HargaBeli,
            'harga_jual' => $Harga,
            'status' => $Status,
            'bayar_penuh' =>$BayarPenuh,
            'cicilan' => $Cicilan,
            'estimasi' => $Estimasi,
            'foto' => $filename, 
            'stok' => $Stok
        ]);

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/master_produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Produk = MsProduk::findorfail($id);
        $Mutasi = JbMutasiStok::where('id_produk', $id)->get();
        return view('admin.ms_produk.show', compact('Produk', 'Mutasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Produk = MsProduk::findorfail($id);
        $Kategori   = MsKategori::all();
        return view('admin.ms_produk.edit', compact('Produk', 'Kategori'));
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
        $this->validate($req, [
            'id_kategori' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga_beli' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'filename.*' => 'mimes:jpg,jpeg,png|max:2000' 
        ]);
        $id         = $req->input('id');
        $IdKategori = $req->input('id_kategori');
        $Nama       = $req->input('nama');
        $Deskripsi  = $req->input('deskripsi');
        $HargaBeli   = str_replace(".","",$req->input('harga_beli'));
        $Harga    = str_replace(".","",$req->input('harga'));
        $BayarPenuh    = $req->has('is_bayarpenuh') ? "Y" : "N";
        $Cicilan       = $req->has('is_cicilan') ? "Y" : "N";
        $Estimasi      = $req->input('estimasi');
        $Status     = $req->input('status');
        $Stok          = $req->input('stok');

        if ($req->hasfile('filename')) {            
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$req->file('filename')->getClientOriginalName());
            $req->file('filename')->move(public_path('images'), $filename);
        }else{
            $filename = $req->input('foto');
        }

        $MsProduk = MsProduk::findorfail($id);
        
        $MsProduk->update([
            'id_kategori' => $IdKategori,
            'nama_barang' => $Nama,
            'deskripsi' => $Deskripsi,
            'harga_beli' => $HargaBeli,
            'harga_jual' => $Harga,
            'status' => $Status,
            'bayar_penuh' =>$BayarPenuh,
            'cicilan' => $Cicilan,
            'estimasi' => $Estimasi,
            'foto' => $filename,
            'stok' => $Stok
        ]);

        DB::update("UPDATE tmp_cart SET harga=? WHERE id_produk=?", [$HargaBeli, $id ]);
        
        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect('admin/master_produk');
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

        $Produk = MsProduk::findorfail($id);

        $CekTrx = JbOrderDetail::where('id_produk', $id)->get();
        if ($CekTrx->count() > 0) {
            Session::flash('error_message', 'Produk sudah digunakan transaksi, tidak dapat dihapus');
            return redirect('admin/master_produk');
        }

        $Produk->delete();
        Session::flash('flash_message', 'Produk berhasil dihapus');
        return redirect('admin/master_produk');
    }
}
