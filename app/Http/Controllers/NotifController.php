<?php

namespace App\Http\Controllers;

use App\AgtTransaksi;
use App\SysNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update($id)
    {
        $Notif  = SysNotification::findorfail($id);
        $Jenis  = $Notif->jenis;
        $IdAgt  = $Notif->id_anggota;
        $IdPengajuan=$Notif->id_pengajuan;
        $IdRekening= $Notif->id_reksimp;
        $Notif->update([
            'is_read' => 1
        ]);

        switch ($Jenis) {
            case 'Anggota':
                return redirect('admin/master_anggota/detail/'.$IdAgt);
                break;
            case 'Pengajuan':
                return redirect('admin/pengajuan/detail/'.$IdPengajuan);
                break;
            case 'Setoran':
                $AgtTrx     = AgtTransaksi::where('id_norek', $IdRekening)->get();
                $IdTrxSimp = [];
                foreach ($AgtTrx as $k) {
                    $IdTrxSimp = $k->id;
                }
                return redirect('admin/simp_verifikasi/detail/'.$IdTrxSimp);
                break;
            default:
                return redirect()->back();
                break;
        }
    }

    public function readall()
    {
        $UserId     = Auth::user()->id;

        DB::update("UPDATE sys_notification SET is_read = 1 WHERE user_id = ?",[$UserId]);
        
        return redirect()->back();
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
