<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemShu;
use App\MsAnggota;
use App\Lib\LibRekening;
use App\SimpRekening;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AgtShuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UserId     = Auth::user()->id;
        $Anggota    = MsAnggota::where('user_id', $UserId)->get();
        $IdAnggota  = [];
        $NamaAgt    = [];
        $Perush     = [];
        foreach($Anggota as $a){
            $IdAnggota = $a->id;           
            $NamaAgt    = $a->nama_anggota;
            $Perush     = $a->Perusahaan->nama;
        }


        /// Hitung Saldo simpanan semua anggota aktif
        $Simpanan = DB::select("select sum(saldo_akhir) as jml_simp from simp_rekening where status_aktif='Y'");
        $JmlSimp = [];
        foreach($Simpanan as $s){
            $JmlSimp = $s->jml_simp;           
        }
        /// Hitung Saldo simpanan Anggota yg login
        $SimpRek = DB::select("select sum(saldo_akhir) as sld_simp from simp_rekening where status_aktif='Y' and id_anggota=?", [$IdAnggota]);
        $SaldoSimp = [];
        foreach($SimpRek as $j){
            $SaldoSimp = $j->sld_simp;           
        }
        $PorsiShuModal   = round(($SaldoSimp/$JmlSimp)*100,2);


        /// Hitung Semua jasa partisipasi anggota
        $JasaAgtAll =DB::select("select sum(nominal) as jasa_all from shu_jasaagt");
        $TotJasaAll = [];
        foreach($JasaAgtAll as $js){
            $TotJasaAll = $js->jasa_all;           
        }
        // dd($TotJasaAll);

        /// Hitung jasa partisipasi anggota yg login
        $JasaAgt =DB::select("select sum(nominal) as jasa_agt from shu_jasaagt where id_anggota=?",[$IdAnggota]);
        $TotJasa = [];
        foreach($JasaAgt as $jsa){
            $TotJasa = $jsa->jasa_agt;           
        }

        if ($TotJasaAll == 0)
        {
            $PorsiShuJasa   = 0;
        }else{
            $PorsiShuJasa   = round(($TotJasa/$TotJasaAll)*100,2);
        }
        $ItemShu    = ItemShu::all();

        $Shu        = 
        DB::select('select sum(shu) as total_shu from akt_arsipshu where year(tanggal) = ?', ['2023']);
        $TotArsShu = [];
        foreach($Shu as $shu){
            $TotArsShu = $shu->total_shu;           
        }
        
        $BlnBerjalan    = LibRekening::getShuBlnBerjalan();

        $TotShuTahun    = $BlnBerjalan+$TotArsShu;
        return view('anggota.shu.index', compact('ItemShu', 'SaldoSimp', 'JmlSimp', 'PorsiShuModal', 'NamaAgt', 'Perush', 'TotJasa', 'TotJasaAll', 'PorsiShuJasa', 'TotShuTahun'));
        
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
