<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = User::all();

        return view('admin.users.index', compact('User'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'nama' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'department' => 'required',
        ]);

        User::create([
            'name' => $req->input('nama'),
            'email' => $req->input('email'),
            'role' => 'Admin',
            'password' => bcrypt($req->input('password')),
            'department' => $req->input('department')
        ]);

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/master_user');
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
        $User = User::findorfail($id);
        // dd($User);
        return view('admin.users.edit', compact('User'));

    }

    public function edit_profil()
    {
        $UserId     = Auth::user()->id;
        $User = User::findorfail($UserId);

        return view('admin.users.edit_profil', compact('User'));
    }

    public function update_profil(Request $req)
    {
        $this->validate($req,[
            'nama' => 'required',
            'email' => 'required | email',
            'password' => 'required',
        ]);
        $id     = $req->input('id');
        $User   = User::findorfail($id);

        $User->update([
            'name' => $req->input('nama'),
            'email' => $req->input('email'),
            'password' => bcrypt($req->input('password'))
        ]);

        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect()->back();     
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
            'email' => 'required | email',
            'password' => 'required',
        ]);
        $id     = $req->input('id');
        $User   = User::findorfail($id);

        $User->update([
            'name' => $req->input('nama'),
            'email' => $req->input('email'),
            'password' => bcrypt($req->input('password'))
        ]);

        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect('admin/master_user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $id     = $req->input('id');

        $User   = User::findorfail($id);
        $User->delete();
        
        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect('admin/master_user');

    }
}
