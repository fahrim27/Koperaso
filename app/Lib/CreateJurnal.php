<?php

namespace App\Lib;

use App\MsAkun;
use App\SysPerush;
use App\AktMutasi;
use DB;
use DateTime;
use Date;
use Illuminate\Support\Carbon;

class CreateJurnal{
    public static function AktMutasi($NoBukti, $KdeAkun, $Nominal, $Tipe, $Ket, $JnsMutasi, $Tanggal){
        if ($Tipe == "debet") {
            $Debet = $Nominal;
            $Kredit = 0;
        }else {
            $Debet = 0;
            $Kredit = $Nominal;
        }
        $user_id = 1;
        // $Tanggal = Carbon::now()->format("Y-m-d");
        AktMutasi::create([
            'no_bukti' => $NoBukti,
            'kde_akun' => $KdeAkun,
            'tanggal' => $Tanggal,
            'debet' => $Debet,
            'kredit' => $Kredit,
            'keterangan' => $Ket,
            'jns_mutasi' => $JnsMutasi,
            'user_id' => $user_id,
        ]);
    }
}
