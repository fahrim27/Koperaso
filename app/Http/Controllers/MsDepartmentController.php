<?php

namespace App\Http\Controllers;

use App\MsDepartment;
use Illuminate\Http\Request;
use Session;

class MsDepartmentController extends Controller
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
        $MsDepartment = MsDepartment::all();

        return view('admin.ms_department.index', compact('MsDepartment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ms_department.create');
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
            'nama' => 'required'
        ]);

        MsDepartment::create([
            'nama' => $req->input('nama')
        ]);

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/ms_department');
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
        $Depart   = MsDepartment::findorfail($id);

        return view('admin.ms_department.edit', compact('Depart'));
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
            'nama' => 'required'
        ]);

        $id = $req->input('id');

        $Depart = MsDepartment::findorfail($id);

        $Depart->update([
            'nama' => $req->input('nama')
        ]);

        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect('admin/ms_department');
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

        $Depart =  MsDepartment::findorfail($id);

        $Depart->delete();
        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect('admin/ms_department');

    }
}
