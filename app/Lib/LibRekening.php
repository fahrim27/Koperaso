<?php

namespace App\Lib;

use App\PbyJadwal;
use App\SimpRekening;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\ChartAccount;
use App\MsAnggota;
use Illuminate\Support\Facades\Auth;


class LibRekening{

    public static function CreateRekSimp($IdAnggota, $Kode, $UserId){
        //  Format No Rekening ( 3 Digit Kode Kantor - 2 digit kode Produk - 5 digit no urut  )
        //  Ex. 0010200001
        $GetKantor= DB::select('select * from sys_perush');
        $KdKantor =[];
        foreach($GetKantor as $k){
            $KdKantor   = $k->kde_kantor;
        }
        

        $GetProduk  = DB::select('select * from simp_master where kode = ?', [$Kode]);
        $IdSimp     = [];
        $KdProduk   = [];
        $Jasa       = [];
        foreach($GetProduk as $k){
            $KdProduk   = $k->kode;
            $IdSimp     = $k->id;
            $Jasa       = $k->persen_jasa;
        }

        $Prefix = $KdKantor.$KdProduk;


        $data=DB::select("SELECT RIGHT(MAX(`no_rek`),5) as `kd_max` FROM `simp_rekening` WHERE LEFT(`no_rek`,5)='$Prefix'");
        $kde_max = [];
        foreach($data as $q){
            $kde_max[] = $q->kd_max;
        }

        if($kde_max[0] == null){
            $No = $Prefix."00001";
        }else{
            $tmp = (int)$kde_max[0]+1;
            $No = $Prefix.str_pad($tmp, 5, "0", STR_PAD_LEFT);
        }
        $TglBuka    = Carbon::now()->format('Y-m-d');
        $Anggota    = MsAnggota::findorfail($IdAnggota);
        switch ($Kode) {
            case '01':
                $Setoran  = $Anggota->Jabatan->simp_pokok;
                break;
            case '02':
                $Setoran  = $Anggota->Jabatan->simp_wajib;
                break;
            case '03':
                $Setoran  = 0;
                break;            
            default:
                # code...
                break;
        }
        
        
        
        $Rek =SimpRekening::create([
            'id_anggota' => $IdAnggota,
            'id_simpanan' => $IdSimp,
            'no_rek' => $No,
            'tgl_buka' => $TglBuka,
            'status_aktif' => 'Y',
            'status_blokir' => 'N',
            'jasa_persen' => $Jasa,
            'user_id' => $UserId,
            'saldo_awal_sys' => 0,
            'saldo_akhir' => 0,
            'setoran' => $Setoran,
            'is_setor' =>0
        ]);

        if ($Rek->id<>0){
            return "Success";
        }else{
            return "Failed";
        }
    }

    public static function CreateRekPby($Kode){
        //  Format No Rekening ( 3 Digit Kode Kantor - 2 digit kode Produk - 5 digit no urut  )
        //  Ex. 0010200001
        $GetKantor= DB::select('select * from sys_perush');
        $KdKantor =[];
        foreach($GetKantor as $k){
            $KdKantor   = $k->kde_kantor;
        }

        $Prefix = $KdKantor.$Kode;


        $data=DB::select("SELECT RIGHT(MAX(`no_rek`),5) as `kd_max` FROM `pby_rekening` WHERE LEFT(`no_rek`,5)='$Prefix'");
        $kde_max = [];
        foreach($data as $q){
            $kde_max[] = $q->kd_max;
        }

        if($kde_max[0] == null){
            $No = $Prefix."00001";
        }else{
            $tmp = (int)$kde_max[0]+1;
            $No = $Prefix.str_pad($tmp, 5, "0", STR_PAD_LEFT);
        }
       return $No;
    }

    public static function CreateJdwAngs($IdRek, $Jasa, $Plafond, $Jangka, $TglCair){
        $TglB4      = $TglCair;

        for ($i=1; $i <= $Jangka; $i++) { 
            
            $AngPokok  = round($Plafond/$Jangka,0);
            // $AngJasa    = ($Plafond*($Jasa/100));
            $AngJasa    =floor($Plafond*($Jasa/100)/100)*100;
            $TglAngs    = Carbon::parse($TglB4)->addMonth(1)->format('Y-m-d');

            if($i==$Jangka){
                $PbySum     = 
                DB::select("select sum(angs_pokok) as jmlangs from pby_jadwal where id_norek = ?", [$IdRek]);
                
                $JmlAngs  = [];
        
                foreach($PbySum as $s){
                    $JmlAngs   = $s->jmlangs;
                }

                $AngPokok   = $Plafond-$JmlAngs;                
            }

            PbyJadwal::create([
                'id_norek' => $IdRek,
                'tanggal' => $TglAngs,
                'angske' => $i,
                'angs_pokok'=> $AngPokok,
                'angs_jasa' => $AngJasa,
                'tag_pokok' => $AngPokok,
                'tag_jasa' => $AngJasa,
                'status' => '',
                'user_id' => 1,
            ]);

            $TglB4=$TglAngs;
        }  
    }

    public static function getShuBulan($Bulan){
        $DataShu    = DB::select("select shu from akt_arsipshu where month(tanggal)=?",[$Bulan]);
        $Shu =[];
        foreach($DataShu as $j){
            $Shu = $j->shu;
        }

        return $Shu==[] ? 0 : $Shu;
    }

    public static function getShuBlnBerjalan(){
        $Bln   = Carbon::now()->month;
        $Thn   = Carbon::now()->year;
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
        $Pendptan = ChartAccount::where('jenis', 'Pendapatan')->get();
        $TotPendpt  = DB::select("select sum(saldo_akhir) as pendpt from chart_account where jenis='Pendapatan'");
        $JmlPendpt  = [];
        foreach($TotPendpt as $p){
            $JmlPendpt  = $p->pendpt;
        }
        $Biaya = ChartAccount::where('jenis', 'Biaya')->get();
        $TotBiaya  = DB::select("select sum(saldo_akhir) as biaya from chart_account where jenis='Biaya'");
        $JmlBiaya  = [];
        foreach($TotBiaya as $b){
            $JmlBiaya  = $b->biaya;
        }

        $Shu    = $JmlPendpt-$JmlBiaya;

        return $Shu;
    }

}
