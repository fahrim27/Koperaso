<?php

namespace App\Lib;

use App\SysPengurus;


class LibMaster{
    public static function getPengurus($key){
        $Data = SysPengurus::where('posisi',$key)->get();

        $Email =[];
        foreach ($Data as $k) {
            $Email = $k->email;
        }

        return $Email;
    }

}
