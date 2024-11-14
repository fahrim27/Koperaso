<?php

namespace App\Http\Controllers;

use App\Lib\LibMaster;
use App\SysPeriode;
use App\SysPerush;
use App\ChartAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SysPerush = SysPerush::all();
        $NamaKop    = [];
        $Alamat     = [];
        $Cabang     = [];
        $Kota       = [];
        $Email      = [];
        $Website    = [];
        $IsNotif = [];
        $IsStok = [];
        foreach ($SysPerush as $k) {
            $NamaKop    = $k->nma_perush;
            $Alamat     = $k->alm_perush;
            $Cabang     = $k->nma_cabang;
            $Kota       = $k->kta_perush;
            $Email      = $k->eml_perush;
            $Website    = $k->website;
            $IsNotif = $k->email;
            $IsStok     = $k->stok_inventory;
        }

        $IsCheckStok   = $IsStok == 1 ? 'checked' : '';
        $IsCheckNotif   = $IsNotif == 1 ? 'checked' : '';
        $Ketua  = LibMaster::getPengurus("Ketua");
        $Sekretaris  = LibMaster::getPengurus("Sekretaris");
        $Bendahara  = LibMaster::getPengurus("Bendahara");
        $Ujb  = LibMaster::getPengurus("Jual Beli");
        
        $TglMulai   = periodeTagihan("tgl_mulai");
        $TglSelesai = periodeTagihan('tgl_selesai');

        $Akun = ChartAccount::orderby('kde_akun','ASC')->get();

        return view('admin.setting.index', compact('NamaKop', 'Alamat', 'Cabang', 'Kota', 'Email', 'Website', 'Ketua', 'Sekretaris', 'Bendahara', 'Ujb', 'TglMulai', 'TglSelesai', 'IsCheckNotif', 'IsCheckStok', 'Akun'));
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
    public function update_perush(Request $req)
    {
        $this->validate($req,[
            'nama_koperasi' => 'required',
            'alamat' => 'required',
            'cabang' => 'required',
            'kota' => 'required',
            'email' => 'required|email',
            'website' => 'required',
        ]);
        $SysPerush = SysPerush::findorfail(2);

        $SysPerush->update([
            "nma_perush" => $req->input('nama_koperasi'),
            "nma_cabang" => $req->input('cabang'),
            "alm_perush" => $req->input('alamat'),
            "kta_perush" => $req->input('kota'),
            "eml_perush" => $req->input('email'),
            "website" => $req->input('website'),
            "stok_inventory" => $req->has('is_stok') ? "1" : "0"
        ]);

        Session::flash('flash_message', 'Data berhasil diperbarui');
        return redirect()->back()->withInput();
    }

    public function update_notif(Request $req)
    {
        $this->validate($req,[
            'ketua' => 'required|email',
            'sekretaris' => 'required|email',
            'bendahara' => 'required|email',
            'jual_beli' => 'required|email',
        ]);

        $Ketua   = $req->input('ketua');
        $Sekretaris   = $req->input('sekretaris');
        $Bendahara   = $req->input('bendahara');
        $Ujb   = $req->input('jual_beli');
        $IsNotif    = $req->has('is_notif') ? "1" : "0";

        DB::update("UPDATE sys_pengurus SET email=? WHERE posisi=?", [$Ketua,'Ketua']);
        DB::update("UPDATE sys_pengurus SET email=? WHERE posisi=?", [$Sekretaris,'Sekretaris']);
        DB::update("UPDATE sys_pengurus SET email=? WHERE posisi=?", [$Bendahara,'Bendahara']);
        DB::update("UPDATE sys_pengurus SET email=? WHERE posisi=?", [$Ujb,'Jual Beli']);

        
        DB::update("UPDATE sys_perush SET email=?", [$IsNotif]);
        

        Session::flash('flash_message', 'Data berhasil diperbarui');
        return redirect()->back()->withInput();
    }

    public function update_periode(Request $req)
    {
        $this->validate($req,[
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);

        $TglMulai = $req->input('tgl_mulai');
        $TglSelesai = $req->input('tgl_selesai');


        $Periode = SysPeriode::findorfail(1);
        $Periode->update([
            'tgl_mulai' => $TglMulai,
            'tgl_selesai' => $TglSelesai,
        ]);

        Session::flash('flash_message', 'Data berhasil diperbarui');
        return redirect()->back()->withInput();
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
