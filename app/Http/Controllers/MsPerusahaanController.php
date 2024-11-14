<?php

namespace App\Http\Controllers;

use App\MsPerusahaan;
use Illuminate\Http\Request;
use Session;

class MsPerusahaanController extends Controller
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
        $MsPerush = MsPerusahaan::all();

        return view('admin.ms_perusahaan.index', compact('MsPerush'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ms_perusahaan.create');
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
            'inisial' => 'required',
            'nama' => 'required'
        ]);

        MsPerusahaan::create([
            'nama' => $req->input('nama'),
            'inisial' => $req->input('inisial'),
        ]);

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/ms_perusahaan');
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
        $Perush     = MsPerusahaan::findorfail($id);

        return view('admin.ms_perusahaan.edit', compact('Perush'));
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
            'inisial' => 'required',
            'nama' => 'required'
        ]);
        $id = $req->input('id');
        $Perush = MsPerusahaan::findorfail($id);
        $Perush->update([
            'nama' => $req->input('nama'),
            'inisial' => $req->input('inisial'),
        ]);

        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect('admin/ms_perusahaan');
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

        $Perush = MsPerusahaan::findorfail($id);

        $Perush->delete();
        Session::flash('flash_message', 'Perusahaan berhasil dihapus');
        return redirect('admin/ms_perusahaan');

        
    }
}
