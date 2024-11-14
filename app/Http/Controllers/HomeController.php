<?php

namespace App\Http\Controllers;

use App\ArsipShu;
use App\Models\User;
use App\MsAnggota;
use App\SimpRekening;
use App\PbyRekening;
use App\ChartAccount;
use App\Lib\LibAkun;
use App\Lib\LibNotification;
use App\Lib\LibRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Mail;
use App\Mail\MyTestMail;
use App\PbyJadwal;
use App\SysNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        // $NomPokok   = 8200000;
        // $Sisa   = $NomPokok;
        // $id   = 4;
        // $LastAngs   = 3;
        // do {
        //     $PbyJadwal = PbyJadwal::where('id_norek',$id)->where('angske', $LastAngs)->get();
        //     $TagPokok = [];
        //     foreach ($PbyJadwal as $k){
        //        $TagPokok = $k->tag_pokok;
        //     }
            
        //     if ($TagPokok >0 && $Sisa>$TagPokok) {
        //         $Sisa  = $Sisa-$TagPokok;
        //         $AngsPokok = $TagPokok;
        //         DB::update("UPDATE pby_jadwal SET tag_pokok=tag_pokok-? WHERE id_norek=? AND angske=?",[$AngsPokok,$id,$LastAngs]);
        //     }else{
        //         $AngsPokok = $Sisa;
        //         $Sisa  = 0;                
        //         DB::update("UPDATE pby_jadwal SET tag_pokok=tag_pokok-? WHERE id_norek=? AND angske=?",[$AngsPokok,$id,$LastAngs]);
        //     }     
        //     $LastAngs++;              
        // } while ($Sisa >0);

        $UserId     = Auth::user()->id;
        $UserDetail = User::where('id',$UserId)->get();
        $NamaUser    = [];
        $Email      = [];
        $Role = [];
        foreach($UserDetail as $k){
            $NamaUser    = $k->name;
            $Email      = $k->email;
            $Role       = $k->department;
            switch ($Role) {
                case 'ADMIN':
                    $Depart = "Administrator";
                    break;
                case 'CFO':
                    $Depart = "Administrator";
                    break;
                case 'HR':
                    $Depart = "HRD";
                    break;
                case 'UJB':
                    $Depart = "Unit Jual Beli";
                    break;
                case 'USP':
                    $Depart = "Unit Simpan Pinjam";
                    break;
                default:
                    # code...
                    break;
            }
        }

        $Anggota = DB::select("SELECT count(*) as jml_agt FROM ms_anggota WHERE status_keanggotaan='Aktif'");
        $JmlAnggota = [];
        foreach($Anggota as $n){
            $JmlAnggota = $n->jml_agt;           
        }

        $Simpanan = DB::select("select sum(saldo_akhir) as jml_simp from simp_rekening where status_aktif='Y'");
        $JmlSimp = [];
        foreach($Simpanan as $s){
            $JmlSimp = $s->jml_simp;           
        }

        $Pinjaman = DB::select("SELECT sum(r.saldo_akhir) AS jml_pby FROM pby_rekening r, pby_master m WHERE r.id_pinjaman=m.id AND r.status='Aktif'");
        $JmlPby = [];
        $JnsPby = [];
        foreach($Pinjaman as $s){
            $JmlPby = $s->jml_pby;
            // $JnsPby = $s->
        }

        $TglSelesai = periodeTagihan('tgl_selesai');
        $Bln   = Carbon::parse($TglSelesai)->month;
        $Thn   = Carbon::parse($TglSelesai)->year;
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
        

        $Jan    = LibRekening::getShuBulan(1);
        $Feb    = LibRekening::getShuBulan(2);
        $Mar    = LibRekening::getShuBulan(3);
        $Apr    = LibRekening::getShuBulan(4);
        $Mei    = LibRekening::getShuBulan(5);
        $Jun    = LibRekening::getShuBulan(6);
        $Jul    = LibRekening::getShuBulan(7);
        $Agt    = LibRekening::getShuBulan(8);
        $Sep    = LibRekening::getShuBulan(9);
        $Okt    = LibRekening::getShuBulan(10);
        $Nov    = LibRekening::getShuBulan(11);
        $Des    = LibRekening::getShuBulan(12);
        switch ($Bln) {
            case 1:
                $Jan    = $Shu;
                break;
            case 2:
                $Feb    = $Shu;
                break;
            case 3:
                $Mar    = $Shu;
                break;
            case 4:
                $Apr    = $Shu;
                break;
            case 5:
                $Mei    = $Shu;
                break;
            case 6:
                $Jun    = $Shu;
                break;
            case 7:
                $Jul    = $Shu;
                break;
            case 8:
                $Agt    = $Shu;
                break;
            case 9:
                $Sep    = $Shu;
                break;
            case 10:
                $Okt    = $Shu;
                break;
            case 11:
                $Nov    = $Shu;
                break;
            case 12:
                $Des    = $Shu;
                break;    
            default:                
                break;
        }
        
        return view('admin.dashboard.index', compact('JmlAnggota', 'JmlSimp', 'JmlPby', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des', 'NamaUser', 'Email', 'Depart'));
    }

    public function anggota()
    {
        $UserId     = Auth::user()->id;
        $Anggota    = MsAnggota::where('user_id', $UserId)->get();
        $IdAnggota  = [];
        $NamaAgt    = [];
        $Email      = [];
        $Perush = [];
        $Department = [];
        $StsAnggota = [];
        foreach($Anggota as $a){
            $IdAnggota = $a->id;           
            $NamaAgt    = $a->nama_anggota;
            $Email    = $a->email;
            $Perush     = $a->Perusahaan->nama;
            $Department = $a->Department->nama;
            $StsAnggota = $a->status_keanggotaan;
        }
        // dd($IdAnggota);
        $SimpRek    = SimpRekening::where('id_anggota', $IdAnggota)->get();
        $PbyRek     = PbyRekening::where('id_anggota', $IdAnggota)->get();
        // dd($PbyRek);

        $Simpanan = DB::select("select sum(saldo_akhir) as jml_simp from simp_rekening where status_aktif='Y' and id_anggota=?",[$IdAnggota]);
        $JmlSimp = [];
        foreach($Simpanan as $s){
            $JmlSimp = $s->jml_simp;           
        }

        $Pinjaman = DB::select("select sum(saldo_akhir) as jml_pby from pby_rekening where status='Aktif' and id_anggota=?",[$IdAnggota]);
        $JmlPby = [];
        foreach($Pinjaman as $s){
            $JmlPby = $s->jml_pby;           
        }
        $Tgl = Carbon::now()->format('Y-m-d');
        $PbyAngs    = DB::select("SELECT r.id, j.tanggal, j.angs_pokok, j.angs_jasa FROM pby_rekening r, pby_jadwal j WHERE r.id=j.id_norek AND r.id_anggota=? AND j.tanggal=?",[$IdAnggota,$Tgl]);
        if ($PbyAngs != []){
            $IdPinjaman= [];
            $AngsPokok = [];
            $AngsJasa   = [];
            foreach ($PbyAngs as $k) {
                $IdPinjaman = $k->id;
                $AngsPokok = $k->angs_pokok;
                $AngsJasa   = $k->angs_jasa;
                $Total = $AngsPokok+$AngsJasa;

                $Ket = "Tagihan Anda Sebesar Rp ".number_format($Total,2)." Jatuh Tempo Hari Ini";

                $CekNotif = SysNotification::where('role', 'Anggota')->where('jenis','Pinjaman')->where('id_rekpby',$IdPinjaman)->where('user_id', $UserId)->count();
                if ($CekNotif<=0) {
                    LibNotification::CreateNotif($IdAnggota, 0, $IdPinjaman, 0, 'Pinjaman', $Ket, 'Anggota', $UserId);
                }
                
            }
        }
        $Notification = SysNotification::where('role', 'Anggota')->where('is_read',0)->where('user_id', $UserId)->count();

        return view('anggota.dashboard.index', compact('Email','NamaAgt', 'SimpRek', 'PbyRek', 'JmlSimp', 'JmlPby', 'Perush', 'Department', 'StsAnggota'));
    }

    public function readall()
    {
        $UserId     = Auth::user()->id;
        DB::update("UPDATE sys_notification SET is_read = 1 WHERE user_id = ?",[$UserId]);
        
        return redirect()->back();
    }
}
