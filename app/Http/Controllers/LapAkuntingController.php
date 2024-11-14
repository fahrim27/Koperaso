<?php

namespace App\Http\Controllers;

use App\ChartAccount;
use App\Lib\LibAkun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapAkuntingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function jurnal()
    {
        $KasMutasi = DB::select("SELECT t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.keterangan, t.debet, t.kredit, t.id FROM chart_account a, akt_mutasi t WHERE t.kde_akun=a.kde_akun order by t.id, t.no_bukti ASC, t.tanggal DESC");

        return view('admin.lap_akunting.jurnal', compact('KasMutasi'));
    }

    public function jurnal_filter(Request $req)
    {
        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');
        $KasMutasi = DB::select("SELECT t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.keterangan, t.debet, t.kredit, t.id FROM chart_account a, akt_mutasi t WHERE t.kde_akun=a.kde_akun and t.tanggal>=? and t.tanggal<=? order by t.id, t.no_bukti ASC, t.tanggal DESC",[$TglMulai, $TglSelesai]);

        return view('admin.lap_akunting.jurnal', compact('KasMutasi'));
    }

    public function jurnal_cetak(Request $req)
    {
        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');
        $KasMutasi = DB::select("SELECT t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.keterangan, t.debet, t.kredit, t.id FROM chart_account a, akt_mutasi t WHERE t.kde_akun=a.kde_akun and t.tanggal>=? and t.tanggal<=? order by t.id, t.no_bukti ASC, t.tanggal DESC",[$TglMulai, $TglSelesai]);

        return view('admin.lap_akunting.cetak_jurnal', compact('KasMutasi', 'TglMulai', 'TglSelesai'));
    }

    public function labarugi_index()
    {
        $Labarugi   = [];
        $Pendptan = [];       
        $JmlPendpt  = [];        
        $Biaya = [];       
        $JmlBiaya  = [];
        
        return view('admin.lap_akunting.labarugi', compact('Pendptan', 'Biaya', 'JmlPendpt', 'JmlBiaya'));
    }

    public function labarugi_show(Request $req)
    {
        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');
        DB::query("update chart_account set saldo_akhir =0");

        $Akun = ChartAccount::all();
        $total_akun = $Akun->count();
        foreach($Akun as $a){       
            $id         = $a->id;     
            $KodeAkun   =trim($a->kde_akun);
            $Jenis      = $a->jenis;
            if ($Jenis == 'Pendapatan' or $Jenis == 'Pasiva'){
                $GetMutasi  = DB::select("select (sum(kredit)-sum(debet)) as jumlah from akt_mutasi where kde_akun=? and tanggal>=? and tanggal<=?", [$KodeAkun, $TglMulai, $TglSelesai]);
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
                $GetMutasi  = DB::select("select (sum(debet)-sum(kredit)) as jumlah from akt_mutasi where kde_akun=? and tanggal>=? and tanggal<=?", [$KodeAkun, $TglMulai, $TglSelesai]);
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

        return view('admin.lap_akunting.labarugi', compact('Pendptan', 'Biaya', 'JmlPendpt', 'JmlBiaya'));
    }

    public function labarugi_cetak(Request $req)
    {
        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');
        DB::query("update chart_account set saldo_akhir =0");

        $Akun = ChartAccount::all();
        $total_akun = $Akun->count();
        foreach($Akun as $a){       
            $id         = $a->id;     
            $KodeAkun   =trim($a->kde_akun);
            $Jenis      = $a->jenis;
            if ($Jenis == 'Pendapatan' or $Jenis == 'Pasiva'){
                $GetMutasi  = DB::select("select (sum(kredit)-sum(debet)) as jumlah from akt_mutasi where kde_akun=? and tanggal>=? and tanggal<=?", [$KodeAkun, $TglMulai, $TglSelesai]);
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
                $GetMutasi  = DB::select("select (sum(debet)-sum(kredit)) as jumlah from akt_mutasi where kde_akun=? and tanggal>=? and tanggal<=?", [$KodeAkun, $TglMulai, $TglSelesai]);
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

        return view('admin.lap_akunting.cetak_labarugi', compact('Pendptan', 'Biaya', 'JmlPendpt', 'JmlBiaya', 'TglMulai', 'TglSelesai'));
    }

    public function bukubesar_index()
    {
        $Akun = ChartAccount::orderBy('kde_akun')->get();
        $BukBes = [];
        $KodeAkun   ='';
        $TglMulai   = Carbon::now()->format('Y-m-d');
        $TglSelesai   = Carbon::now()->format('Y-m-d');
        
        return view('admin.lap_akunting.bukubesar', compact('Akun', 'BukBes', 'KodeAkun', 'TglMulai', 'TglSelesai'));
    }

    public function bukubesar_show(Request $req)
    {
        
        $this->validate($req,[
            'kde_akun' => 'required'
        ]);
        
        $KodeAkun   = $req->input('kde_akun');
        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');
        $Akun = ChartAccount::orderBy('kde_akun')->get();
        $DetAkun      = ChartAccount::where('kde_akun',$KodeAkun)->get();
        $Jenis  = [];
        foreach ($DetAkun as $k) {
            $Jenis  = $k->jenis;
        }

        $BukBes     = DB::select("select t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.debet, t.kredit, t.keterangan from akt_mutasi t, chart_account a where t.kde_akun=a.kde_akun and t.kde_akun=? and t.tanggal>=? and t.tanggal<=? order by t.tanggal, t.id", [$KodeAkun, $TglMulai, $TglSelesai]);
        
        if ($BukBes !=[]){
            $TotBukBes     = DB::select("select sum(t.debet) as debet, sum(t.kredit) as kredit from akt_mutasi t, chart_account a where t.kde_akun=a.kde_akun and t.kde_akun=? and t.tanggal>=? and t.tanggal<=? group by t.kde_akun", [$KodeAkun, $TglMulai, $TglSelesai]);

            $TotDebet = [];
            $TotKredit= [];
            foreach ($TotBukBes as $t) {
                $TotDebet = $t->debet;
                $TotKredit= $t->kredit;
            }

            switch ($Jenis) {
                case 'Aktiva':
                case 'Biaya':
                    $SaldoAkhir = $TotDebet - $TotKredit;
                    break;
                case 'Pasiva':
                case 'Pendapatan':
                    $SaldoAkhir = $TotKredit-$TotDebet;
                    break;
                default:
                    $SaldoAkhir = 0;
                    break;
            }
        }else{
            $TotDebet = 0;
            $TotKredit= 0;
            $SaldoAkhir = 0;
        }

        return view('admin.lap_akunting.bukubesar', compact('Akun', 'BukBes', 'KodeAkun', 'TglMulai', 'TglSelesai', 'SaldoAkhir', 'TotDebet', 'TotKredit'));
    }
    public function bukubesar_cetak(Request $req)
    {
        
        $this->validate($req,[
            'kde_akun' => 'required'
        ]);
        
        $KodeAkun   = $req->input('kde_akun');
        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');
        $Akun = ChartAccount::all();
        $MsAkun   = ChartAccount::where('kde_akun', $KodeAkun)->get();
        $NamaAkun  = [];
        $Jenis  = [];
        foreach($MsAkun as $j){
            $NamaAkun   = $j->nma_akun;
            $Jenis      = $j->jenis;
        }


        $BukBes     = DB::select("select t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.debet, t.kredit, t.keterangan from akt_mutasi t, chart_account a where t.kde_akun=a.kde_akun and t.kde_akun=? and t.tanggal>=? and t.tanggal<=? order by t.id", [$KodeAkun, $TglMulai, $TglSelesai]);

        if ($BukBes !=[]){
            $TotBukBes     = DB::select("select sum(t.debet) as debet, sum(t.kredit) as kredit from akt_mutasi t, chart_account a where t.kde_akun=a.kde_akun and t.kde_akun=? and t.tanggal>=? and t.tanggal<=? group by t.kde_akun", [$KodeAkun, $TglMulai, $TglSelesai]);

            $TotDebet = [];
            $TotKredit= [];
            foreach ($TotBukBes as $t) {
                $TotDebet = $t->debet;
                $TotKredit= $t->kredit;
            }

            switch ($Jenis) {
                case 'Aktiva':
                case 'Biaya':
                    $SaldoAkhir = $TotDebet - $TotKredit;
                    break;
                case 'Pasiva':
                case 'Pendapatan':
                    $SaldoAkhir = $TotKredit-$TotDebet;
                    break;
                default:
                    $SaldoAkhir = 0;
                    break;
            }
        }else{
            $TotDebet = 0;
            $TotKredit= 0;
            $SaldoAkhir = 0;
        }

        return view('admin.lap_akunting.cetak_bukubesar', compact('NamaAkun','Akun', 'BukBes', 'KodeAkun', 'TglMulai', 'TglSelesai', 'TotDebet', 'TotKredit', 'SaldoAkhir'));
    }

    public function aruskas_index(){
        $ArusKas        = [];
        $SaldoAwal      = 0;
        $Masuk          = 0;
        $Keluar         = 0;
        $SaldoAkhir     = 0;
        $TglMulai       = Carbon::now()->format('Y-m-d');
        $TglSelesai     = Carbon::now()->format('Y-m-d');
        return view('admin.lap_akunting.aruskas', compact( 'SaldoAwal', 'Masuk', 'Keluar', 'SaldoAkhir', 'TglMulai', 'TglSelesai', 'ArusKas'));
    }

    public function aruskas_show(Request $req){

        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');

        // $TglAwal    = Carbon::parse($TglMulai)->subDays(1)->format('Y-m-d');

        $AkunKas    = LibAkun::AkunKAS();
        $HitungSaldo    = DB::select("select (sum(debet)-sum(kredit)) as saldo_awal from akt_mutasi where tanggal<? and kde_akun=?", [$TglMulai, $AkunKas]);
        

        $SaldoAwal = [];
        foreach ($HitungSaldo as $k) {
            $SaldoAwal  = $k->saldo_awal;
        }

        $HitungMutasi    = DB::select("select sum(debet) as masuk, sum(kredit) as keluar from akt_mutasi where tanggal>=? and tanggal<=? and kde_akun=?", [$TglMulai, $TglSelesai, $AkunKas]);

        $Masuk = [];
        $Keluar = [];
        foreach ($HitungMutasi as $m) {
            $Masuk = $m->masuk;
            $Keluar = $m->keluar;
        }

        $SaldoAkhir     = $SaldoAwal+$Masuk-$Keluar;

        $ArusKas       = DB::select("select t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.debet, t.kredit, t.keterangan from akt_mutasi t, chart_account a where t.kde_akun=a.kde_akun and t.kde_akun=? and t.tanggal>=? and t.tanggal<=? order by t.id", [$AkunKas, $TglMulai, $TglSelesai]);

        return view('admin.lap_akunting.aruskas', compact('ArusKas', 'SaldoAwal', 'Masuk', 'Keluar', 'SaldoAkhir', 'TglMulai', 'TglSelesai'));

    }

    public function aruskas_cetak(Request $req){

        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');

        // $TglAwal    = Carbon::parse($TglMulai)->subDays(1)->format('Y-m-d');

        $AkunKas    = LibAkun::AkunKAS();
        $HitungSaldo    = DB::select("select (sum(debet)-sum(kredit)) as saldo_awal from akt_mutasi where tanggal<? and kde_akun=?", [$TglMulai, $AkunKas]);
        

        $SaldoAwal = [];
        foreach ($HitungSaldo as $k) {
            $SaldoAwal  = $k->saldo_awal;
        }

        $HitungMutasi    = DB::select("select sum(debet) as masuk, sum(kredit) as keluar from akt_mutasi where tanggal>=? and tanggal<=? and kde_akun=?", [$TglMulai, $TglSelesai, $AkunKas]);

        $Masuk = [];
        $Keluar = [];
        foreach ($HitungMutasi as $m) {
            $Masuk = $m->masuk;
            $Keluar = $m->keluar;
        }

        $SaldoAkhir     = $SaldoAwal+$Masuk-$Keluar;

        $ArusKas       = DB::select("select t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.debet, t.kredit, t.keterangan from akt_mutasi t, chart_account a where t.kde_akun=a.kde_akun and t.kde_akun=? and t.tanggal>=? and t.tanggal<=? order by t.id", [$AkunKas, $TglMulai, $TglSelesai]);

        return view('admin.lap_akunting.cetak_aruskas', compact('ArusKas', 'SaldoAwal', 'Masuk', 'Keluar', 'SaldoAkhir', 'TglMulai', 'TglSelesai'));

    }

    public function neracasaldo_index()
    {
        $Neraca   = [];
        $Bln = [];       
        $Thn  = [];     
        
        return view('admin.lap_akunting.neraca_saldo', compact('Bln', 'Thn', 'Neraca'));
    }

    public function neracasaldo_show(Request $req)
    {
        $Bln    = $req->input('bulan');
        $Thn    = $req->input('tahun');
        $AkunShuThnBerjalan = LibAkun::AkunShuThnJln();
        $AkunShuThnLalu = LibAkun::AkunShuThnLalu();
        DB::query("update chart_account set saldo_akhir =0");
        $TglAwal= $Thn."-".$Bln."-01";

        $Akun = ChartAccount::all();
        $total_akun = $Akun->count();
        foreach($Akun as $a){       
            $id         = $a->id;     
            $KodeAkun   = trim($a->kde_akun);
            $Jenis      = $a->jenis;
            if ($Jenis == 'Pendapatan' or $Jenis == 'Pasiva'){
                $GetMutasi  = DB::select("select sum(debet) as debet, sum(kredit) as kredit, (sum(kredit)-sum(debet)) as jumlah from akt_mutasi where kde_akun=? and month(tanggal)=? and year(tanggal)=?", [$KodeAkun, $Bln, $Thn]);
                $JmlMutasi = [];
                $Debet = [];
                $Kredit =[];

                foreach($GetMutasi as $j){
                    if($j->jumlah == null){
                        $Debet = 0;
                        $Kredit = 0;    
                        $JmlMutasi   = 0;
                    }else{
                        $Debet = $j->debet;
                        $Kredit = $j->kredit;    
                        $JmlMutasi   = $j->jumlah;
                    }
                    
                    $AktAkun = ChartAccount::findorfail($id);
                    $AktAkun->update([
                        'debet' => $Debet,
                        'kredit' => $Kredit,
                        'saldo_akhir' => $JmlMutasi
                    ]);
                }
            }else{
                $GetMutasi  = DB::select("select sum(debet) as debet, sum(kredit) as kredit, (sum(debet)-sum(kredit)) as jumlah from akt_mutasi where kde_akun=? and month(tanggal)=? and year(tanggal)=?", [$KodeAkun, $Bln, $Thn]);

                $JmlMutasi = [];
                $Debet = [];
                $Kredit =[];

                foreach($GetMutasi as $j){
                    if($j->jumlah == null){
                        $Debet = 0;
                        $Kredit = 0;  
                        $JmlMutasi   = 0;
                    }else{
                        $Debet = $j->debet;
                        $Kredit = $j->kredit; 
                        $JmlMutasi   = $j->jumlah;
                    }
                    
                    $AktAkun = ChartAccount::findorfail($id);
                    $AktAkun->update([
                        'debet' => $Debet,
                        'kredit' => $Kredit,
                        'saldo_akhir' => $JmlMutasi
                    ]);

                }
            }            
        }

        /// Hitung SHU Bulan Ini Saja
        $TotPendpt  = DB::select("select sum(saldo_akhir) as pendpt from chart_account where jenis='Pendapatan'");
        $JmlPendpt  = [];
        foreach($TotPendpt as $p){
            $JmlPendpt  = $p->pendpt;
        }
        $TotBiaya  = DB::select("select sum(saldo_akhir) as biaya from chart_account where jenis='Biaya'");
        $JmlBiaya  = [];
        foreach($TotBiaya as $b){
            $JmlBiaya  = $b->biaya;
        }
        $ShuBlnIni = $JmlPendpt-$JmlBiaya;

        /// Hitung Akumulasi SHU Bulan Sebelumya
        $ArsipShu = DB::select("SELECT sum(shu) AS tot_shu FROM akt_arsipshu WHERE tanggal<?", [$TglAwal]);
        $TotShuBerjalan = [];
        foreach ($ArsipShu as $k) {
            $TotShuBerjalan = $k->tot_shu;
        }

        /// Jumlahkan semua SHU Tahun Berjalan
        $TotalShuIni    = $ShuBlnIni+$TotShuBerjalan;
        DB::update("UPDATE chart_account SET saldo_akhir=? WHERE kde_akun=?",[$TotalShuIni,$AkunShuThnBerjalan]);

        $Neraca = ChartAccount::orderBy('kde_akun','ASC')->get();

        return view('admin.lap_akunting.neraca_saldo', compact('Bln', 'Thn', 'Neraca'));
    }
    
    public function neracasaldo_cetak(Request $req)
    {
        $Bln    = $req->input('bulan');
        $Thn    = $req->input('tahun');
        
        DB::query("update chart_account set saldo_akhir =0");

        $Akun = ChartAccount::all();
        $total_akun = $Akun->count();
        foreach($Akun as $a){       
            $id         = $a->id;     
            $KodeAkun   = trim($a->kde_akun);
            $Jenis      = $a->jenis;
            if ($Jenis == 'Pendapatan' or $Jenis == 'Pasiva'){
                $GetMutasi  = DB::select("select sum(debet) as debet, sum(kredit) as kredit, (sum(kredit)-sum(debet)) as jumlah from akt_mutasi where kde_akun=? and month(tanggal)=? and year(tanggal)=?", [$KodeAkun, $Bln, $Thn]);
                $JmlMutasi = [];
                $Debet = [];
                $Kredit =[];

                foreach($GetMutasi as $j){
                    if($j->jumlah == null){
                        $Debet = 0;
                        $Kredit = 0;    
                        $JmlMutasi   = 0;
                    }else{
                        $Debet = $j->debet;
                        $Kredit = $j->kredit;    
                        $JmlMutasi   = $j->jumlah;
                    }
                    
                    $AktAkun = ChartAccount::findorfail($id);
                    $AktAkun->update([
                        'debet' => $Debet,
                        'kredit' => $Kredit,
                        'saldo_akhir' => $JmlMutasi
                    ]);
                }
            }else{
                $GetMutasi  = DB::select("select sum(debet) as debet, sum(kredit) as kredit, (sum(debet)-sum(kredit)) as jumlah from akt_mutasi where kde_akun=? and month(tanggal)=? and year(tanggal)=?", [$KodeAkun, $Bln, $Thn]);

                $JmlMutasi = [];
                $Debet = [];
                $Kredit =[];

                foreach($GetMutasi as $j){
                    if($j->jumlah == null){
                        $Debet = 0;
                        $Kredit = 0;  
                        $JmlMutasi   = 0;
                    }else{
                        $Debet = $j->debet;
                        $Kredit = $j->kredit; 
                        $JmlMutasi   = $j->jumlah;
                    }
                    
                    $AktAkun = ChartAccount::findorfail($id);
                    $AktAkun->update([
                        'debet' => $Debet,
                        'kredit' => $Kredit,
                        'saldo_akhir' => $JmlMutasi
                    ]);

                }
            }            
        }

        $Neraca = ChartAccount::orderBy('kde_akun','ASC')->get();

        return view('admin.lap_akunting.cetak_neraca_saldo', compact('Bln', 'Thn', 'Neraca'));
    }


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
