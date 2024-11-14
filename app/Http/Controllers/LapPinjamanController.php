<?php

namespace App\Http\Controllers;

use App\Exports\DetailPinjaman;
use App\Exports\RekapPinjaman;
use App\PbyMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class LapPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PbyMaster  = PbyMaster::all();
        $JnsLap = 1;
        $IdPby = "";
        $LapPby = [];

        return  view('admin.lap_pinjaman.index', compact('LapPby','PbyMaster', 'JnsLap', 'IdPby'));
    }

    public function preview(Request $req)
    {   
        $IdPby = $req->input('kdepby');
        $JnsLap   = $req->input('jns_lap');
        $PbyMaster = PbyMaster::all();

        if ($req->input('btnPreview')){
            if ($JnsLap=="1") {
                if ($IdPby == null) {
                    $LapPby = 
                    DB::select("SELECT r.id_pinjaman, m.nama, SUM(r.saldo_akhir) AS saldo FROM pby_master m, pby_rekening r WHERE r.id_pinjaman= m.id GROUP BY r.id_pinjaman, m.nama");   
                }else{
                    $LapPby = 
                    DB::select("SELECT r.id_pinjaman, m.nama, SUM(r.saldo_akhir) AS saldo FROM pby_master m, pby_rekening r WHERE r.id_pinjaman= m.id AND r.id_pinjaman=? GROUP BY r.id_pinjaman, m.nama",[$IdPby]); 
                }
            }else{
                if ($IdPby == null) {
                    $LapPby    = DB::select("SELECT r.no_rek, a.nama_anggota, m.nama, r.plafond, r.tgl_cair, r.jangka, r.jth_tempo, r.angske, r.saldo_akhir FROM pby_rekening r, pby_master m, ms_anggota a WHERE r.id_anggota=a.id AND r.id_pinjaman=m.id AND r.status='Aktif' ORDER BY r.no_rek");
                }else{
                    $LapPby    = DB::select("SELECT r.no_rek, a.nama_anggota, m.nama, r.plafond, r.tgl_cair, r.jangka, r.jth_tempo, r.angske, r.saldo_akhir FROM pby_rekening r, pby_master m, ms_anggota a WHERE r.id_anggota=a.id AND r.id_pinjaman=m.id AND r.status='Aktif' AND r.id_pinjaman=? ORDER BY r.no_rek",[$IdPby]);
                }
            }

            return  view('admin.lap_pinjaman.index', compact('LapPby','PbyMaster', 'JnsLap', 'IdPby'));
        }else{
            if ($JnsLap == "1"){    
                return Excel::download(new RekapPinjaman($IdPby), 'Rekap Pinjaman.xlsx');
            }else{
                return Excel::download(new DetailPinjaman($IdPby), 'Laporan Saldo Pinjaman.xlsx');
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
