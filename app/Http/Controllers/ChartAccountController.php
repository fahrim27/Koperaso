<?php

namespace App\Http\Controllers;

use App\AktSetting;
use App\ChartAccount;
use App\Lib\LibAkun;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;


class ChartAccountController extends Controller
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
        $Akun= ChartAccount::orderBy('kde_akun', 'ASC')->paginate(30);
        return view('admin.master_akun.index', compact('Akun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master_akun.create');

    }

    public function create_subakun($id)
    {
        $MsAkun = ChartAccount::findorfail($id);
        return view('admin.master_akun.subakun.create', compact('MsAkun'));
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
            'jenis' => 'required',
            'nama' => 'required'
        ]);

        $Jenis    = $req->input('jenis');
        switch ($Jenis) {
            case '1':
                $JnsAkun = 'Aktiva';
                break;
            case '2':
                $JnsAkun = 'Pasiva';
                break;
            case '3':
                $JnsAkun = 'Modal';
                break;
            case '4':
                $JnsAkun = 'Pendapatan';
                break;
            case '5':
                $JnsAkun = 'Biaya';
                break;
        }

        $KodeAkun = LibAkun::CreateKodeAkun($Jenis);

      ChartAccount::create([
        'jenis' => $JnsAkun,
        'kde_akun' => $KodeAkun,
        'nma_akun' => strtoupper($req->input('nama')),
        'pos_akun' => 1,
        'saldo_awal' => 0,
        'debet' => 0,
        'kredit' => 0,
        'saldo_akhir' => 0,
      ]);
      Session::flash('flash_message', 'Data Berhasil Ditambahkan');
      return redirect('admin/master_akun');
    }

    public function store_subakun(Request $req)
    {
        $this->validate($req, [
            'namasub' => 'required'
        ]);
        $KodeAkun = $req->input('kde_akun');
        $Id = $req->input('id');
        $Jenis = $req->input('jenis');

        $KodeSubAkun = LibAkun::CreateSubAkun($KodeAkun);
        ChartAccount::create([
            'jenis' => $Jenis,
            'kde_akun' => $KodeSubAkun,
            'nma_akun' => "  ".$req->input('namasub'),
            'pos_akun' => 2,
            'saldo_awal' => 0,
            'debet' => 0,
            'kredit' => 0,
            'saldo_akhir' => 0,
        ]);
        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/master_akun');
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
        $MsAkun = ChartAccount::findorfail($id);
        return view('admin.master_akun.edit', compact('MsAkun'));
    }

    public function edit_subakun($id)
    {
        $MsAkun = ChartAccount::findorfail($id);
        $KdeAkun = substr($MsAkun->kde_akun,0,6);
        $Akun    = ChartAccount::all()->where('kde_akun', $KdeAkun)->first();

        return view('admin.master_akun.subakun.edit', compact('MsAkun', 'Akun'));
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
            'nama' => 'required'
          ]);
          $MsAkun = ChartAccount::findorfail($req->input('id'));

          $MsAkun->update([
            'nma_akun' => $req->input('nama'),
            'saldo_awal' =>$req->input('saldo_awal'),
          ]);

          Session::flash('flash_message', 'Data Berhasil Diperbarui');
          return redirect('admin/master_akun');
    }

    public function update_subakun(Request $req)
    {
        $this->validate($req, [
            'namasub' => 'required'
          ]);
          $MsAkun = ChartAccount::findorfail($req->input('id'));

          $MsAkun->update([
            'nma_akun' => "   ".$req->input('namasub'),
          ]);

          Session::flash('flash_message', 'Data Berhasil Diperbarui');
          return redirect('admin/master_akun');
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

        $Akun = ChartAccount::findorfail($id);
        if ($Akun->pos_akun == 1){
            $KdeInduk = substr($Akun->kde_akun,0,6);
            $AllAkun  = DB::select("SELECT count(*) as jml FROM `chart_account` WHERE LEFT(`kde_akun`,6)=$KdeInduk and `pos_akun`=2");
            $Jml = [];
            foreach ($AllAkun as $k) {
                $Jml = $k->jml;
            }
            if ($Jml>0){
                Session::flash('error_message', 'Akun tersebut memiliki subakun, tidak dapat dihapus');
                return redirect('admin/master_akun');
            }
        }

        $Akun->delete();
        Session::flash('flash_message', 'Akun berhasil dihapus');
        return redirect('admin/master_akun');
    }

    public function setting_akun()
    {
        $Akun = ChartAccount::orderby('kde_akun','ASC')->get();
        $AktSetting  = AktSetting::first();

        $AkunKas        = $AktSetting->akun_kas;
        $AkunPersediaan    = $AktSetting->akun_persediaan;
        $AkunShuThnBerjalan= $AktSetting->shu_thnberjalan;
        $AkunShuThnLalu    = $AktSetting->shu_thnlalu;

        return view('admin.master_akun.setting_akun', compact('Akun', 'AkunKas', 'AkunPersediaan', 'AkunShuThnBerjalan', 'AkunShuThnLalu'));
    }


    public function update_setting(Request $req)
    {
        $this->validate($req,[
            'akun_kas' => 'required',
            'akun_persediaan' => 'required',
            'akun_shuthnberjalan' => 'required',
            'akun_shuthnlalu' => 'required',
        ]);


        $AkunKas    = $req->input('akun_kas');
        $AkunPersediaan    = $req->input('akun_persediaan');
        $AkunShuThnBerjalan    = $req->input('akun_shuthnberjalan');
        $AkunShuThnLalu    = $req->input('akun_shuthnlalu');

        $Akun= AktSetting::findorfail(1);
        $Akun->update([
            'akun_kas' => $AkunKas,
            'akun_persediaan' => $AkunPersediaan,
            'shu_thnberjalan' => $AkunShuThnBerjalan,
            'shu_thnlalu' => $AkunShuThnLalu
        ]);

        Session::flash('flash_message', 'Pengaturan Akunting Berhasil Diperbarui');
        return redirect()->back();
    }
}
