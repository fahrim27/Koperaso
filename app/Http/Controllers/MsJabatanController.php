<?php

namespace App\Http\Controllers;

use App\MsJabatan;
use Illuminate\Http\Request;
use Session;

class MsJabatanController extends Controller
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
        $Jabatan = MsJabatan::all();

        return view('admin.ms_jabatan.index', compact('Jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ms_jabatan.create');
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
            'jabatan'=> 'required',
            'simp_pokok' => 'required',
            'simp_wajib' => 'required'
        ]);

        $Nama       = $req->input('jabatan');
        $SimpPokok  = str_replace(".","",$req->simp_pokok);
        $SimpWajib  = str_replace(".","",$req->simp_wajib);



        MsJabatan::create([
            'nama' => $Nama,
            'simp_pokok' => $SimpPokok,
            'simp_wajib' => $SimpWajib
        ]);

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/ms_jabatan');
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
        $MsJabatan  = MsJabatan::findorfail($id);

        return view('admin.ms_jabatan.edit', compact('MsJabatan'));
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
            'jabatan'=> 'required',
            'simp_pokok' => 'required',
            'simp_wajib' => 'required'
        ]);

        $id         = $req->input('id');
        $Nama       = $req->input('jabatan');
        $SimpPokok  = str_replace(".","",$req->simp_pokok);
        $SimpWajib  = str_replace(".","",$req->simp_wajib);

        $Jabatan    = MsJabatan::findorfail($id);
        $Jabatan->update([
            'nama' => $Nama,
            'simp_pokok' => $SimpPokok,
            'simp_wajib' => $SimpWajib
        ]);

        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect('admin/ms_jabatan');
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

        $Jabatan = MsJabatan::findorfail($id);
        $Jabatan->delete();

        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect('admin/ms_jabatan');
    }
}
