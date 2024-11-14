<?php

namespace App\Http\Controllers;

use App\SimpMaster;
use App\SimpMutasi;
use App\SimpRekening;
use App\MsAnggota;
use App\Lib\LibRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class SimpRekeningController extends Controller
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
        $SimpRek    = SimpRekening::where('status_aktif', 'Y')->get();
        // dd($SimpRek);

        return view('admin.simp_rekening.index', compact('SimpRek', 'SimpMaster'));
    }

    public function filter(Request $req)
    {
        $SimpMaster = SimpMaster::all();
        $SimpRek    = SimpRekening::where('status_aktif', 'Y')->where('id_simpanan', $req->input('kdesimp')) ->get();

        return view('admin.simp_rekening.index', compact('SimpRek', 'SimpMaster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Anggota    = MsAnggota::where('status_keanggotaan', 'Aktif')->get();
        $SimpMaster = SimpMaster::all();

        return view('admin.simp_rekening.create',compact('Anggota', 'SimpMaster'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {   
        $IdAnggota  = $req->input('id_anggota');
        $Kode       = $req->input('id_simpanan');
        $UserId = Auth::user()->id;
        $Rek    = LibRekening::CreateRekSimp($IdAnggota,$Kode, $UserId);

        Session::flash('flash_message', 'Rekening telah dibuat');
        return redirect('admin/simp_rekening');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SimpRek = SimpRekening::findorfail($id);
        $IdRek  = $SimpRek->id;
        $Norek  = $SimpRek->no_rek;

        $SimpMutasi = DB::select("select * from simp_mutasi where no_rek='$Norek' order by tanggal, no_bukti ASC");
        $JmlMutasi  = DB::select("select sum(debet) as debet, sum(kredit) as kredit from simp_mutasi where no_rek='$Norek' group by no_rek");

        $JmlDebet  = [];
        $JmlKredit  = [];
        
        foreach($JmlMutasi as $j){
            $JmlDebet   = $j->debet;
            $JmlKredit   = $j->kredit;
        }   

        return view('admin.simp_rekening.show', compact('SimpRek', 'SimpMutasi', 'JmlDebet', 'JmlKredit'));
    }

    public function update_setoran(Request $req)
    {
        $id     = $req->input('id');
        $Nominal    = str_replace(".","",$req->input('jumlah'));
        $SimpRek    = SimpRekening::findorfail($id);
        $SimpRek->update([
            'setoran' => $Nominal
        ]);

        Session::flash('flash_message', 'Setoran Simpanan Wajib Telah Diperbarui');
        return redirect('admin/simp_rekening');
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
    public function update(Request $request, $id)
    {
        //
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
