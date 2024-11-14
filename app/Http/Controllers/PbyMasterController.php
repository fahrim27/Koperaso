<?php

namespace App\Http\Controllers;

use App\PbyMaster;
use Illuminate\Http\Request;
use App\ChartAccount;
use App\Lib\LibMaster;
use App\PbyRekening;
use Session;

class PbyMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PbyMaster = PbyMaster::all();

        return view('admin.pby_master.index', compact('PbyMaster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AkunAkt        = ChartAccount::where('jenis', 'Aktiva')->get();
        $AkunPendpt     = ChartAccount::where('jenis', 'Pendapatan')->get();

        return view('admin.pby_master.create', compact('AkunAkt','AkunPendpt'));
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
            'kode' => 'required',
            'nama' => 'required',
            'akun_produk' => 'required',
            'akun_jasa' =>'required',
            'akun_adm' => 'required',
            'jenis_pinjaman' => 'required',
        ]);

        $Kode   = $req->input('kode');
        $Nama   = $req->input('nama');
        $AkunPby   = $req->input('akun_produk');
        $AkunJasa   = $req->input('akun_jasa');
        $AkunAdm    = $req->input('akun_adm');
        $Persen     = $req->persen_jasa;
        $Adm        = $req->persen_adm;
        $Jenis      = $req->input('jenis_pinjaman');

        $CekPby     = PbyMaster::where('kode', $Kode)->get();
        if ($CekPby->count()>=1){
            Session::flash('error_message', 'Kode sudah digunakan');
            return redirect()->back()->withInput();     
        }

        PbyMaster::create([
            'kode' => $Kode,
            'nama' => $Nama,
            'akun_produk' => $AkunPby,
            'akun_jasa' => $AkunJasa,
            'akun_adm' => $AkunAdm,
            'persen_jasa' => $Persen,
            'persen_adm' => $Adm,
            'jenis_pinjaman' => $Jenis,
            'status' => 'Y'
        ]);

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/pby_master');

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
        $PbyMaster = PbyMaster::findorfail($id);
        $AkunAkt        = ChartAccount::where('jenis', 'Aktiva')->get();
        $AkunPendpt     = ChartAccount::where('jenis', 'Pendapatan')->get();

        return view('admin.pby_master.edit', compact('PbyMaster', 'AkunAkt', 'AkunPendpt'));

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
        $this->validate($req,[
            'nama' => 'required',
            'akun_produk' => 'required',
            'akun_jasa' =>'required',
            'akun_adm' => 'required',
            'jenis_pinjaman' => 'required',
        ]);

        $id   = $req->input('id');
        $Nama   = $req->input('nama');
        $AkunPby   = $req->input('akun_produk');
        $AkunJasa   = $req->input('akun_jasa');
        $AkunAdm    = $req->input('akun_adm');
        $Persen     = $req->persen_jasa;
        $Adm        = $req->persen_adm;
        $Jenis      = $req->input('jenis_pinjaman');

        $PbyMaster = PbyMaster::findorfail($id);
        
        $PbyMaster->update([
            'nama' => $Nama,
            'akun_produk' => $AkunPby,
            'akun_jasa' => $AkunJasa,
            'akun_adm' => $AkunAdm,
            'persen_jasa' => $Persen,
            'persen_adm' => $Adm,
            'jenis_pinjaman' => $Jenis,
            'status' => 'Y'
        ]);

        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect('admin/pby_master');        
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
        $PbyRek    = PbyRekening::where('id_pinjaman', $id)->get();

        if ($PbyRek->count()>=1){
            Session::flash('error_message', 'Produk pinjaman sudah digunakan');
            return redirect()->back();     
        }

        $PbyMaster = PbyMaster::findorfail($id);
        $PbyMaster->delete();

        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect()->back();  
    }
}
