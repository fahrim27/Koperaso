<?php

namespace App\Http\Controllers;

use App\Exports\DetailSimpanan;
use App\Exports\RekapSimpanan;
use App\SimpMaster;
use App\SimpRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LapSimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SimpMaster = SimpMaster::all();
        $JnsLap = 1;
        $IdSimp = "";
        $LapSimp = [];

        return  view('admin.lap_simpanan.index', compact('LapSimp','SimpMaster', 'JnsLap', 'IdSimp'));
    }

    public function preview(Request $req)
    {
        $IdSimp = $req->input('kdesimp');
        $JnsLap   = $req->input('jns_lap');
        $SimpMaster = SimpMaster::all();

        if ($req->input('btnPreview')){
            if ($JnsLap=="1") {
                if ($IdSimp == null) {
                    $LapSimp =
                    DB::select("SELECT r.id_simpanan, m.nama, SUM(r.saldo_akhir) AS saldo FROM simp_master m, simp_rekening r WHERE r.id_simpanan= m.id GROUP BY r.id_simpanan, m.nama");
                }else{
                    $LapSimp =
                    DB::select("SELECT r.id_simpanan, m.nama, SUM(r.saldo_akhir) AS saldo FROM simp_master m, simp_rekening r WHERE r.id_simpanan= m.id AND r.id_simpanan=? GROUP BY r.id_simpanan, m.nama",[$IdSimp]);
                }
            }else{
                if ($IdSimp == null) {
                    $LapSimp    = SimpRekening::where('status_aktif', 'Y')->where('saldo_akhir', '>', '0')->get();
                }else{
                    $LapSimp    = SimpRekening::where('status_aktif', 'Y')->where('saldo_akhir', '>', '0')->where('id_simpanan', $IdSimp)->get();
                }
            }

            return view('admin.lap_simpanan.index', compact('SimpMaster', 'LapSimp', 'JnsLap', 'IdSimp'));
        }else{
            if ($JnsLap == "1"){
                return Excel::download(new RekapSimpanan($IdSimp), 'Rekap Simpanan.xlsx');
            }else{
                return Excel::download(new DetailSimpanan($IdSimp), 'Laporan Saldo Simpanan.xlsx');
            }
        }

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
