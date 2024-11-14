<?php

namespace App\Http\Controllers;

use App\ChartAccount;
use App\SimpMaster;
use App\SimpRekening;
use Illuminate\Http\Request;
use Session;

class SimpMasterController extends Controller
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
        $SimpMaster = SimpMaster::all();

        return view('admin.simp_master.index', compact('SimpMaster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AkunPsv    = ChartAccount::where('jenis', 'Pasiva')->get();
        $AkunBya    = ChartAccount::where('jenis', 'Biaya')->get();

        return view('admin.simp_master.create', compact('AkunPsv', 'AkunBya'));
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
            'akun_simp' => 'required'            
        ]);

        $Kode   = $req->input('kode');
        $Nama   = $req->input('nama');
        $AkunSimp   = $req->input('akun_simp');
        $AkunJasa   = $req->input('akun_jasa');
        $Persen     = str_replace(".","",$req->persen_jasa);
        $CekSimp    = SimpMaster::where('kode', $Kode)->get();
        if ($CekSimp->count()>=1){
            Session::flash('error_message', 'Kode sudah digunakan');
            return redirect()->back()->withInput();     
        }

        SimpMaster::create([
            'kode'=> $Kode,
            'nama' => $Nama,
            'akun_produk' => $AkunSimp,
            'akun_jasa' => $AkunJasa,
            'persen_jasa' => $Persen=="" ? 0 : $Persen,
            'status' => 'Y'
        ]);

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/simp_master');
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
        $SimpMaster = SimpMaster::findorfail($id);
        $AkunPsv    = ChartAccount::where('jenis', 'Pasiva')->get();
        $AkunBya    = ChartAccount::where('jenis', 'Biaya')->get();

        return view('admin.simp_master.edit', compact('SimpMaster', 'AkunPsv', 'AkunBya'));
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
            'akun_simp' => 'required'            
        ]);

        $id     = $req->input('id');
        $Nama   = $req->input('nama');
        $AkunSimp   = $req->input('akun_simp');
        $AkunJasa   = $req->input('akun_jasa') == null ? '' : $req->input('akun_jasa');
        $Persen     = str_replace(".","",$req->persen_jasa);

        $SimpMaster = SimpMaster::findorfail($id);

        $SimpMaster->update([
            'nama' => $Nama,
            'akun_produk' => $AkunSimp,
            'akun_jasa' => $AkunJasa,
            'persen_jasa' => $Persen=="" ? 0 : $Persen,
            'status' => 'Y'
        ]);

        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect('admin/simp_master');
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
        $SimpRek    = SimpRekening::where('id_simpanan', $id)->get();

        if ($SimpRek->count()>=1){
            Session::flash('error_message', 'Produk simpanan sudah digunakan');
            return redirect()->back();     
        }

        $SimpMaster = SimpMaster::findorfail($id);
        $SimpMaster->delete();

        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect()->back();   
    }
}
