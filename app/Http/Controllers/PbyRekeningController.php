<?php

namespace App\Http\Controllers;

use App\PbyJadwal;
use App\PbyMutasi;
use App\PbyRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PbyRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $PbyRekening    = PbyRekening::all();
        return view('admin.pby_rekening.index', compact('PbyRekening'));
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
        $PbyRekening    = PbyRekening::findorfail($id);
        $PbyMutasi      = PbyMutasi::where('id_norek', $id)->get();
        // dd($PbyMutasi);
        $JdwAngs        = PbyJadwal::where('id_norek', $id)->get();
        $Ke         = $PbyRekening->angske;
        // DB::select("select max(angske) as angs from pby_jadwal where id_norek=? and status='OK'", [$id]);
        // $Ke= [];
        // foreach($AngsKe as $k){
        //     if ($k->angs == null){
        //         $Ke= 1;
        //     }else{
        //         $Ke= $k->angs+1;
        //     }
        // }
        $Status='OK';
        $PbyAng = DB::select("select sum(tag_pokok) as angs_pokok, sum(tag_jasa) as angs_jasa from pby_jadwal where id_norek=? and angske<=? and status<>?", [$id, $Ke, $Status]);

        $Ke= [];
        if ($PbyAng!=[]){
            foreach($PbyAng as $a){
                $NomPokok   = $a->angs_pokok;
                $NomJasa   = $a->angs_jasa;
            }
        }else{
            $NomPokok   = 0;
            $NomJasa   = 0;
        }
        
        return view('admin.pby_rekening.show', compact('NomPokok', 'NomJasa','PbyRekening', 'JdwAngs', 'PbyMutasi'));
    }

    public function cetak_bukti($id)
    {
        $PbyMutasi  = PbyMutasi::findorfail($id);

        return view('admin.pby_mutasi.print', compact('PbyMutasi'));
        
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
