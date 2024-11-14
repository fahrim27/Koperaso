<?php

namespace App\Http\Controllers;

use App\Exports\RekapPenjualan;
use App\Exports\PenjualanPerBarang;
use App\JbOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanUjbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Lap = [];
        $JnsLap = 1;
        $TglMulai       = Carbon::now()->format('Y-m-d');
        $TglSelesai     = Carbon::now()->format('Y-m-d');
        return view('admin.purchasing.lap_penjualan.index', compact('TglMulai','TglSelesai', 'Lap', 'JnsLap'));
    }

    public function lap_penjualan(Request $req)
    {
        $TglMulai = $req->input('tgl_mulai');
        $TglSelesai = $req->input('tgl_selesai');
        $JnsLap   = $req->input('jns_lap');
        if ($req->input('btnPreview')){
            if ($JnsLap == 1){
                $Lap    = DB::select("SELECT t.id, t.no_trx, t.tanggal, a.nama_anggota, t.total, t.pembayaran FROM jb_order t, ms_anggota a WHERE t.id_anggota=a.id AND t.tanggal>=? AND t.tanggal<=? AND t.status_order='Selesai'", [$TglMulai, $TglSelesai]);
            }else{
                $Lap = DB::select("SELECT m.id, m.nama_barang, d.qty, d.hpp, d.harga, ((d.harga-d.hpp)*d.qty) AS margin FROM jb_order t, jb_order_detail d, ms_produk m WHERE d.id_order=t.id AND d.id_produk=m.id AND t.status_order='Selesai' AND t.tanggal>=? AND t.tanggal<=? GROUP BY m.id, m.nama_barang, d.qty, d.hpp, d.harga ",[$TglMulai, $TglSelesai]);
            }

            return view('admin.purchasing.lap_penjualan.index', compact('TglMulai', 'TglSelesai', 'Lap', 'JnsLap'));
        }else{
            $Tgl1   = Carbon::parse($TglMulai)->translatedFormat('d-M-Y');
            $Tgl2  = Carbon::parse($TglSelesai)->translatedFormat('d-M-Y');            if ($JnsLap == "1"){    
                return Excel::download(new RekapPenjualan($TglMulai, $TglSelesai), 'Rekap Penjualan '.$Tgl1.' - '.$Tgl2.'.xlsx');
            }else{
                return Excel::download(new PenjualanPerBarang($TglMulai, $TglSelesai), 'Penjualan per Barang '.$Tgl1.' - '.$Tgl2.'.xlsx');
            }
        }
    }

    public function export_excel(Request $req)
    {
        $TglMulai = $req->get('tgl_mulai');
        $TglSelesai = $req->get('tgl_selesai');
        $JnsLap   = $req->get('jns_lap');
        
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
