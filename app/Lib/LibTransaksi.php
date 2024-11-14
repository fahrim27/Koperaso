<?php

namespace App\Lib;

use App\ChartAccount;
use App\SysPerush;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Carbon;

class LibTransaksi{

    public static function NoAnggota($Prefix){
        //  Format No Anggota ( 3 Digit Inisial - 4 digit no urut  )
        //  Ex. PNC0001

        $data=DB::select("SELECT RIGHT(MAX(`no_anggota`),4) as `kd_max` FROM `ms_anggota` WHERE LEFT(`no_anggota`,3)='$Prefix'");
        $kde_max = [];
        foreach($data as $q){
            $kde_max[] = $q->kd_max;
        }

        if($kde_max[0] == null){
            $No = $Prefix."0001";
        }else{
            $tmp = (int)$kde_max[0]+1;
            $No = $Prefix.str_pad($tmp, 4, "0", STR_PAD_LEFT);
        }
        return $No;
    }

    public static function NoBukti($Tgl){
        //  Format No Bukti ( 2 Digit Kd Kantor - 6 digit tgl (yymmdd) - 4 digit no urut  )
        //  Ex. 011810140001
        $SysPerush = SysPerush::all()->first();
        $Kantor = substr($SysPerush->kde_kantor, 1, 2); ;
        $Prefix = $Kantor.$Tgl;
        $data=DB::select("SELECT RIGHT(MAX(`no_bukti`),4) as `kd_max` FROM `akt_mutasi` WHERE LEFT(`no_bukti`,8)='$Prefix'");
        $kde_max = [];
        foreach($data as $q){
            $kde_max[] = $q->kd_max;
        }

        if($kde_max[0] == null){
            $No = $Prefix."0001";
        }else{
            $tmp = (int)$kde_max[0]+1;
            $No = $Prefix.str_pad($tmp, 4, "0", STR_PAD_LEFT);
        }
        return $No;
    }

    public static function NoPengajuan($Tgl){
        //  Format No Pengajuan ( "P" - 2 Digit Kd Kantor - 6 digit tgl (yymmdd) - 4 digit no urut  )
        //  Ex. P011810140001
        $SysPerush = SysPerush::all()->first();
        $Kantor = substr($SysPerush->kde_kantor, 1, 2); ;
        $Prefix = "P".$Kantor.$Tgl;
        $data=DB::select("SELECT RIGHT(MAX(`no_pengajuan`),4) as `kd_max` FROM `pby_pengajuan` WHERE LEFT(`no_pengajuan`,9)='$Prefix'");
        $kde_max = [];
        foreach($data as $q){
            $kde_max[] = $q->kd_max;
        }

        if($kde_max[0] == null){
            $No = $Prefix."0001";
        }else{
            $tmp = (int)$kde_max[0]+1;
            $No = $Prefix.str_pad($tmp, 4, "0", STR_PAD_LEFT);
        }
        return $No;
    }

    public static function NoOrder($Tgl){
        //  Format No Pengajuan ( "T" - 2 Digit Kd Kantor - 6 digit tgl (yymmdd) - 4 digit no urut  )
        //  Ex. P011810140001
        $SysPerush = SysPerush::all()->first();
        $Kantor = substr($SysPerush->kde_kantor, 1, 2); ;
        $Prefix = "T".$Kantor.$Tgl;
        $data=DB::select("SELECT RIGHT(MAX(`no_trx`),4) as `kd_max` FROM `jb_order` WHERE LEFT(`no_trx`,9)='$Prefix'");
        $kde_max = [];
        foreach($data as $q){
            $kde_max[] = $q->kd_max;
        }

        if($kde_max[0] == null){
            $No = $Prefix."0001";
        }else{
            $tmp = (int)$kde_max[0]+1;
            $No = $Prefix.str_pad($tmp, 4, "0", STR_PAD_LEFT);
        }
        return $No;
    }

    public static function getNoUrutMemo($Prefix){
        $data=DB::select("SELECT RIGHT(MAX(`no_bukti`),6) as `kd_max` FROM `akt_mutasi` WHERE LEFT(`no_bukti`,6)='$Prefix'");
        $kde_max = [];
        foreach($data as $q){
            $kde_max[] = $q->kd_max;
        }

        if($kde_max[0] == null){
            $No = "000001";
        }else{
            $tmp = (int)$kde_max[0]+1;
            $No = str_pad($tmp, 6, "0", STR_PAD_LEFT);
        }
        return $No;
    }

    public static function CreateNotif($IdAgt, $IdSimp, $IdPby, $Jenis, $Ket, $Role){
        $Tanggal = Carbon::now()->format("Y-m-d");

    }
}
