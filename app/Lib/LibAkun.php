<?php

namespace App\Lib;

use App\ChartAccount;
use App\SysPerush;
use Illuminate\Support\Facades\DB;

class LibAkun{
  public static function CreateKodeAkun($prefix){
    $SysPerush = SysPerush::all()->first();

    $Kantor = $SysPerush->kde_kantor;

    switch ($prefix) {
      case '1':
        $jenis = 'Aktiva';
        break;
      case '2':
          $jenis = 'Pasiva';
          break;
      case '3':
          $jenis = 'Modal';
          break;
      case '4':
          $jenis = 'Pendapatan';
          break;
      case '5':
          $jenis = 'Biaya';
          break;
    }
    $kd_prefix =$Kantor.$prefix;

    $MsAkun = DB::table("chart_account")
      ->where('jenis',$jenis)
      ->where('pos_akun', '=', '1')
      ->max('kde_akun');

    $MaxNoAkun  = substr($MsAkun,-2);

    if($MaxNoAkun == null){
      $KdeAkun = $kd_prefix."01";
    }else{
      $tmp = ((int)substr($MaxNoAkun,-2))+1;
      if (strlen(strval($tmp)) == 1){
        $prx ="0";
      }else{
        $prx = "";
      }
      $KdeAkun = $kd_prefix.$prx.$tmp;
    }
    return $KdeAkun;
  }

  public static function CreateSubAkun($prefix){
    $data=DB::select("SELECT MAX(`kde_akun`) as `kd_max` FROM `chart_account` WHERE LEFT(`kde_akun`,6)=$prefix and `pos_akun`=2");

    $kde_max = [];
    foreach($data as $q){
      $kde_max[] = $q->kd_max;
    }

    if($kde_max[0] == null){
      $KdeSubAkun = $prefix."01";
    }else{
      $MaxNoAkun  = substr($kde_max[0],-2);
      $tmp = ((int)$MaxNoAkun)+1;
      $jml_char = strlen(strval($tmp));
      switch ($jml_char) {
        case '1':
          $prx = '0';
          break;
        case '2':
          $prx = '';
          break;
      }
      $KdeSubAkun = $prefix.$prx.$tmp;
    }

    return $KdeSubAkun;
  }

  public static function AkunKAS(){
    $Akun = 
    DB::select("SELECT  akun_kas FROM akt_setting");
    $AkunKas  = [];
    foreach ($Akun as $k) {
      $AkunKas = $k->akun_kas;
    }
    return $AkunKas;
  }

  public static function AkunPersediaan(){
    $Akun = 
    DB::select("SELECT  akun_persediaan FROM akt_setting");
    $AkunPersediaan  = [];
    foreach ($Akun as $k) {
      $AkunPersediaan = $k->akun_persediaan;
    }
    return $AkunPersediaan;
  }

  public static function AkunShuThnJln(){
    $Akun = 
    DB::select("SELECT  shu_thnberjalan FROM akt_setting");
    $AkunShu  = [];
    foreach ($Akun as $k) {
      $AkunShu = $k->shu_thnberjalan;
    }
    return $AkunShu;
  }

  public static function AkunShuThnLalu(){
    $Akun = 
    DB::select("SELECT  shu_thnlalu FROM akt_setting");
    $AkunShuLalu  = [];
    foreach ($Akun as $k) {
      $AkunShuLalu = $k->shu_thnlalu;
    }
    return $AkunShuLalu;
  }
}
