<?php

namespace App\Lib;

use App\SysNotification;
use App\Models\User;
use DB;
use DateTime;
use Date;
use Illuminate\Support\Carbon;

class LibNotification{
    public static function CreateNotif($IdAgt, $IdRekSimp, $IdRekPby, $IdPeng, $Jenis, $Ket, $Role, $UserId)
    {
        $Tanggal = Carbon::now()->format("Y-m-d");
        
        if ($Role=='Admin') {
            $UserAdmin  = User::where('role','Admin')->get();
            foreach ($UserAdmin as $k) {
                $AdminId    = $k->id;                    
                SysNotification::create([
                    'id_anggota' => $IdAgt,
                    'id_reksimp' => $IdRekSimp,
                    'id_rekpby' => $IdRekPby,
                    'id_pengajuan' => $IdPeng,
                    'tanggal' => $Tanggal,
                    'jenis' => $Jenis,
                    'keterangan' => $Ket,
                    'role' => $Role, 
                    'read' => 0,
                    'user_id' => $AdminId,
                ]);                
            }
        }else{
            SysNotification::create([
                'id_anggota' => $IdAgt,
                'id_reksimp' => $IdRekSimp,
                'id_rekpby' => $IdRekPby,
                'id_pengajuan' => $IdPeng,
                'tanggal' => $Tanggal,
                'jenis' => $Jenis,
                'keterangan' => $Ket,
                'role' => $Role, 
                'read' => 0,
                'user_id' => $UserId,
            ]);
        }
    }

}