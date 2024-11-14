<?php

namespace App\Http\Controllers;

use App\ArsipShu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Session;

class ClosingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TglSelesai = periodeTagihan('tgl_selesai');
        $Bln        = Carbon::parse($TglSelesai)->month;
        $Thn        = Carbon::parse($TglSelesai)->year;
        $Shu        = hitungShu($Bln,$Thn);

        return view('admin.closing.index', compact('Shu'));
    }

    public function proses_closing()
    {
        $TglMulai   = periodeTagihan('tgl_mulai');
        $TglSelesai = periodeTagihan('tgl_selesai');
        $Bln        = Carbon::parse($TglSelesai)->month;
        $Thn        = Carbon::parse($TglSelesai)->year;
        $Shu        = hitungShu($Bln,$Thn);

        $NextTglMulai    = Carbon::parse(Carbon::createFromFormat('Y-m-d', $TglMulai )->addMonth())->format('Y-m-d');
        $NextTglSelesai    = Carbon::parse(Carbon::createFromFormat('Y-m-d', $TglSelesai )->addMonth())->format('Y-m-d');

        $TglShu = Carbon::createFromFormat('Y-m-d', $TglSelesai)->endOfMonth()->format('Y-m-d');

        //// Ganti ke Periode Berikutnya
        DB::statement("UPDATE sys_periode SET tgl_mulaitag=?, tgl_selesaitag=?",[$NextTglMulai, $NextTglSelesai]);

        //// Masukan Arsip SHU bulan bersangkutan
        ArsipShu::create([
            'tanggal' => $TglShu,
            'shu'=> $Shu
        ]);

        Auth::logout();
        Session::flash('flash_message', 'Proses Closing Telah Dilakukan, Silahkan Login Kembali');
        return redirect('/login');
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
