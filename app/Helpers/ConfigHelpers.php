<?php

use App\AgtCart;
use App\SysNotification;
use App\SysPerush;
use App\ChartAccount;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\MsAnggota;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

function companySetting($key)
{
    $Perush = SysPerush::all();
    $Nama   = [];
    $Alamat = [];
    $Notif  = [];
    $Telp   = [];
    $Web    = [];
    $NotifEmail = [];
    foreach ($Perush as $k) {
        $Nama   = $k->nma_perush;
        $Alamat = $k->alm_perush.', '.$k->kta_perush;
        $Notif  = $k->notification;
        $Email  = $k->eml_perush;
        $Telp   = $k->tlp_perush;
        $Web    = $k->website;
        $NotifEmail = $k->email;
    }

  switch ($key) {
    case 'nama_koperasi':
        $result  = $Nama;
        break;
    case 'alm_koperasi':
        $result  = $Alamat;
        break;
    case 'is_notification':
        $result = $Notif;
        break;
    case 'tlp_koperasi':
        $result = $Telp;
        break;
    case 'web_koperasi':
        $result = $Web;
        break;
    case 'email_koperasi':
        $result = $Email;
        break;
    case 'notif_email':
        $result = $NotifEmail;
        break;
    default:
        $result = '';
        break;
  }

  return $result;
}

function notifHelper($Role, $Key)
{
    $UserId     = Auth::user()->id;

    $Notification = SysNotification::where('role', $Role)->where('is_read',0)->where('user_id', $UserId)->count();
    if ($Key == "All"){
        return $Notification;
    }
    if ($Role== 'Admin'){
        $Notification = SysNotification::where('role',$Role)->where('is_read',0)->where('user_id', $UserId)->orderBy('id','DESC')->get();

        return $Notification;                

    }else{
        $Notification = SysNotification::where('role','Anggota')->where('is_read',0)->where('user_id', $UserId)->orderBy('id','DESC')->get();
        return $Notification;                
        
    }
}

function userHelpers($Key)
{
    $UserId         = Auth::user()->id;
    $User = User::findorfail($UserId);

    $Department = $User->department;
    switch ($Key) {
        case 'department':
            $result = $Department;
            break;
        
        default:
            $result='NONE';
            break;
    }

    return $result;

}

function cartHelpers($Key)
{
    $UserId         = Auth::user()->id;
    $Anggota        = MsAnggota::where('user_id',$UserId)->get();
    $IdAnggota = [];
    foreach ($Anggota as $k) {
        $IdAnggota = $k->id;
    }
    $Cart = AgtCart::where('id_anggota',$IdAnggota)->where('is_checkout',0)->get();
    switch ($Key) {
        case 'jumlah':
            $result = $Cart->count();
            break;
        
        default:
            $result='NONE';
            break;
    }

    return $result;
}

function periodeTagihan($Key){
    $SysPeriod  = 
    DB::select("SELECT * FROM sys_periode");
    $TglMulai   = [];
    $TglSelesai  = [];
    foreach ($SysPeriod as $k) {
        $TglMulai   = $k->tgl_mulaitag;
        $TglSelesai = $k->tgl_selesaitag;
    }
    switch ($Key) {
        case 'tgl_mulai':
            $Result = $TglMulai;
            break;
        case 'tgl_selesai':
            $Result = $TglSelesai;
            break;
        case 'periode_tag':
            $Result = Carbon::parse($TglSelesai)->translatedFormat('F Y');
            break; 
        case 'periode':
            $Result = substr($TglSelesai,5,2)."-".substr($TglSelesai,0,4);
            break;   
        default:
            $Result ="-";
            break;
    }


    return $Result;
}

function hitungShu($Bln, $Thn){
    DB::query("update chart_account set saldo_akhir =0");

        $Akun = ChartAccount::all();
        $total_akun = $Akun->count();
        foreach($Akun as $a){       
            $id         = $a->id;     
            $KodeAkun   =trim($a->kde_akun);
            $Jenis      = $a->jenis;
            if ($Jenis == 'Pendapatan' or $Jenis == 'Pasiva'){
                $GetMutasi  = DB::select("select (sum(kredit)-sum(debet)) as jumlah from akt_mutasi where kde_akun=? and month(tanggal)=? and year(tanggal)=?", [$KodeAkun, $Bln, $Thn]);
                $JmlMutasi = [];

                foreach($GetMutasi as $j){
                    if($j->jumlah == null){
                        $JmlMutasi   = 0;
                    }else{
                        $JmlMutasi   = $j->jumlah;
                    }
                    
                    $AktAkun = ChartAccount::findorfail($id);
                    $AktAkun->update([
                        'saldo_akhir' => $JmlMutasi
                    ]);
                }
            }else{
                $GetMutasi  = DB::select("select (sum(debet)-sum(kredit)) as jumlah from akt_mutasi where kde_akun=? and month(tanggal)=? and year(tanggal)=?", [$KodeAkun, $Bln, $Thn]);
                $JmlMutasi = [];

                foreach($GetMutasi as $j){
                    if($j->jumlah == null){
                        $JmlMutasi   = 0;
                    }else{
                        $JmlMutasi   = $j->jumlah;
                    }
                    
                    $AktAkun = ChartAccount::findorfail($id);
                    $AktAkun->update([
                        'saldo_akhir' => $JmlMutasi
                    ]);

                }
            }            
        }
        // $Pendptan = ChartAccount::where('jenis', 'Pendapatan')->get();
        $TotPendpt  = DB::select("select sum(saldo_akhir) as pendpt from chart_account where jenis='Pendapatan'");
        $JmlPendpt  = [];
        foreach($TotPendpt as $p){
            $JmlPendpt  = $p->pendpt;
        }
        // $Biaya = ChartAccount::where('jenis', 'Biaya')->get();
        $TotBiaya  = DB::select("select sum(saldo_akhir) as biaya from chart_account where jenis='Biaya'");
        $JmlBiaya  = [];
        foreach($TotBiaya as $b){
            $JmlBiaya  = $b->biaya;
        }

        $Shu    = $JmlPendpt-$JmlBiaya;

        return $Shu;
}