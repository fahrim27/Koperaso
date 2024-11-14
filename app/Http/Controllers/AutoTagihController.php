<?php

namespace App\Http\Controllers;

use App\AutoTagih;
use App\AutoTagihNew;
use App\AutoTagihDetail;
use App\Exports\TagihanExport;
use App\MsAnggota;
use App\PbyJadwal;
use App\PbyMutasi;
use App\PbyRekening;
use App\SimpRekening;
use App\SimpMutasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class AutoTagihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Periode= periodeTagihan('periode');
        $Rekap  = AutoTagihNew::where('periode', $Periode)->get();

        $TotRekap  = DB::select("SELECT sum(simp_pokok) as pokok, sum(simp_wajib) as wajib, sum(simp_sukarela) as suka, sum(cicilan_barang) as cicil, sum(pinjaman_tunai) as tunai, sum(total_tagihan) as tottag FROM tgh_anggota_new WHERE periode=?",[$Periode]);

        $TotPokok   = [];
        $TotWajib   = [];
        $TotSuka    = [];
        $PinjTunai  = [];
        $Cicilan    = [];
        $TotTagihan = [];
        foreach ($TotRekap as $k) {
            $TotPokok   = $k->pokok;
            $TotWajib   = $k->wajib;
            $TotSuka    = $k->suka;
            $PinjTunai  = $k->tunai;
            $Cicilan    = $k->cicil;
            $TotTagihan = $k->tottag;
        }


        
        return view('admin.autotagih.index', compact('Rekap', 'TotPokok', 'TotWajib', 'TotSuka', 'PinjTunai', 'Cicilan', 'TotTagihan'));
    }

    public function proses(Request $req)
    {
        $TglMulai   = periodeTagihan("tgl_mulai");
        $TglSelesai = periodeTagihan('tgl_selesai');
        $Periode= periodeTagihan('periode');

        /// Hapus Data tagihan jika sudah ada        
        DB::delete("DELETE FROM tgh_anggota WHERE periode=?",[$Periode]);

        /// Cari Data Anggota
        $Anggota    = MsAnggota::where('status_keanggotaan','Aktif')->get();
        foreach ($Anggota as $k) {
            AutoTagih::create([
                'periode' => $Periode,
                'id_anggota' => $k->id,
                'simp_pokok'=> 0,
                'simp_wajib'=>0, 
                'simp_sukarela' => 0,
                'cicilan_barang' => 0, 
                'pinjaman_tunai' => 0,
                'total_tagihan' => 0,
                'user_id' =>0
            ]);
        }
        foreach ($Anggota as $k) {

        $IdAnggota  = $k->id;
            ///// Cari Simpanan Anggota
            $SimpRekPokok    = SimpRekening::where('id_anggota', $IdAnggota)->where('status_aktif','Y')->where('id_simpanan', "1")->get();
            if (count($SimpRekPokok)>0){
                foreach ($SimpRekPokok as $s) {
                    $Setoran    = $s->setoran;
                    $IsSetor    = $s->is_setor;

                    if ($IsSetor == 0){
                        $NomPokok   = $Setoran; 
                                                    
                    }else{
                        $NomPokok   = 0;                           
                    }
                    
                    DB::update("update tgh_anggota set simp_pokok=? where id_anggota=?", [$NomPokok, $IdAnggota]);   
                }
            }

            ///// Cari Simpanan Anggota
            $SimpRekwajib    = SimpRekening::where('id_anggota', $IdAnggota)->where('status_aktif','Y')->where('id_simpanan', "2")->where('jmlskip_tagih',"0")->get();

            if (count($SimpRekwajib)>0){
                foreach ($SimpRekwajib as $w) {
                    $Setoran    = $w->setoran;
                    
                    DB::update("update tgh_anggota set simp_wajib=? where id_anggota=?", [$Setoran, $IdAnggota]);   
                }
            }

            // $PbyRek     = PbyRekening::where('id_anggota', $IdAnggota)->where('status','Aktif')->get();
            $PbyRek     = DB::select("SELECT r.*, p.jenis FROM pby_rekening r, pby_pengajuan p WHERE r.id_pengajuan=p.id and r.id_anggota=? and r.status=? and r.tgl_cair<=? ",[$IdAnggota,'Aktif',$TglSelesai]);
            foreach ($PbyRek as $p) {
                $IdPby  = $p->id_pinjaman;
                $IdNorek    = $p->id;
                $Angske = $p->angske;
                $JnsPinjaman    = $p->jenis;


                // $PbyTag = PbyJadwal::where('id_pinjaman', $IdPby)->where('angske', $Angske);

                // $PbyTag = DB::select("select (sum(angs_jasa)+sum(angs_pokok)) as Tag_pby from pby_jadwal where id_norek=? and tanggal>=? and tanggal<=?",[$IdNorek,$TglMulai, $TglSelesai]);
                $PbyTag = DB::select("select (sum(angs_jasa)+sum(angs_pokok)) as Tag_pby from pby_jadwal where id_norek=? and angske=?",[$IdNorek,$Angske]);

                $TagTunai   = [];
                foreach ($PbyTag as $t) {
                    $TagTunai   = round($t->Tag_pby,0);
                }
                if ($JnsPinjaman == "Pinjaman Tunai") {
                    DB::update("update tgh_anggota set pinjaman_tunai=pinjaman_tunai+? where id_anggota=?", [$TagTunai, $IdAnggota]);
                }else{
                    DB::update("update tgh_anggota set cicilan_barang=cicilan_barang+? where id_anggota=?", [$TagTunai, $IdAnggota]);
                }
                
            }
        
        }

        DB::statement("UPDATE tgh_anggota set total_tagihan=simp_pokok+simp_wajib+simp_sukarela+cicilan_barang+pinjaman_tunai where periode='$Periode' and id=id");

        DB::statement("DELETE FROM tgh_anggota where periode='$Periode' and total_tagihan<=0");
        
        $Rekap  = AutoTagih::where('periode',$Periode)->get();
        $TotRekap  = DB::select("SELECT sum(simp_pokok) as pokok, sum(simp_wajib) as wajib, sum(simp_sukarela) as suka, sum(cicilan_barang) as cicil, sum(pinjaman_tunai) as tunai, sum(total_tagihan) as tottag FROM tgh_anggota WHERE periode=?",[$Periode]);

        $TotPokok   = [];
        $TotWajib   = [];
        $TotSuka    = [];
        $PinjTunai  = [];
        $Cicilan    = [];
        $TotTagihan = [];
        foreach ($TotRekap as $k) {
            $TotPokok   = $k->pokok;
            $TotWajib   = $k->wajib;
            $TotSuka    = $k->suka;
            $PinjTunai  = $k->tunai;
            $Cicilan    = $k->cicil;
            $TotTagihan = $k->tottag;
        }
        return view('admin.autotagih.index', compact('Rekap', 'TotPokok', 'TotWajib', 'TotSuka', 'PinjTunai', 'Cicilan', 'TotTagihan'));
    }

    public function postingAutoTagih()
    {
        $TglMulai   = periodeTagihan("tgl_mulai");
        $TglSelesai = periodeTagihan('tgl_selesai');
        $Bulan      = Carbon::parse($TglSelesai)->translatedFormat('F');
        $Tahun      = Carbon::parse($TglSelesai)->format('Y');
        $KetPeriode = $Bulan.' '.$Tahun;
        
        $Periode= periodeTagihan('periode');

        $NoBukti    = 'TAG'.str_replace('-','',$Periode).'001';
        $Tgl    = Carbon::now()->format('Y-m-d');
        $UserId     = Auth::user()->id;

        // $Anggota    = MsAnggota::where('status_keanggotaan','Aktif')->get();
        $Anggota    = 
        DB::select("SELECT * FROM ms_anggota WHERE status_keanggotaan='Aktif' AND date(created_at)<? ORDER BY id", [$TglSelesai,]);
        foreach ($Anggota as $k) {
            $IdAnggota  = $k->id;

            /// Proses Simpanan
            $SimpRek    = SimpRekening::where('id_anggota', $IdAnggota)->where('status_aktif','Y')->where('setoran', '>',0)->where('jmlskip_tagih',"0")->get();
            foreach ($SimpRek as $s) {
                $IdRekSimp  = $s->id;
                $IdSimpanan = $s->id_simpanan;
                $Setoran    = $s->setoran;
                $IsSetor    = $s->is_setor;
                $NorekSimp  = $s->no_rek;
                $Nama       = $s->SimpMaster->nama;

                if($IdSimpanan =="1" && $IsSetor=="1")
                {
                    $IsPosting  = 1;
                }else{
                    $IsPosting  = 0;
                }
                if ($IsPosting == 0) {
                    AutoTagihDetail::create([
                        'periode' => $Periode,
                        'tanggal' => $Tgl,
                        'id_anggota' => $IdAnggota,
                        'id_reksimpanan' => $IdRekSimp,
                        'id_rekpinjaman' => 0,
                        'nominal_pokok' => $Setoran,
                        'nominal_jasa' => 0,
                        'angske' => 0,
                        'jenis' => $Nama, 
                        'id_user' => $UserId
                    ]);
                    if ($IdSimpanan =="1" && $IsSetor == 0){
                        $SimpPokok = SimpRekening::findorfail($IdRekSimp);
                        $SimpPokok->update([
                            'is_setor' => 1
                        ]);
                    }
                    SimpMutasi::create([
                        'id_norek' => $IdRekSimp,
                        'no_bukti' => $NoBukti,
                        'tanggal'  => $Tgl,
                        'no_rek'    => $NorekSimp, 
                        'keterangan' => 'PG Tagihan '.$KetPeriode,
                        'debet' => 0, 
                        'kredit' => $Setoran,
                        'user_id' =>$UserId,
                    ]);

                    DB::update('UPDATE simp_rekening SET saldo_akhir = saldo_akhir+? WHERE no_rek = ?', [$Setoran, $NorekSimp]);
                }
            }

            $PbyRek     = DB::select("SELECT r.*, p.jenis, m.nama FROM pby_rekening r, pby_pengajuan p, pby_master m WHERE r.id_pengajuan=p.id AND r.id_pinjaman=m.id AND r.id_anggota=? AND r.status=? AND r.tgl_cair<=? ",[$IdAnggota,'Aktif',$TglSelesai]);
            foreach ($PbyRek as $p) {
                $IdRekPby   = $p->id;
                $IdPinjaman = $p->id_pinjaman;
                $Angske     = $p->angske;
                $NorekPby   = $p->no_rek;
                $SaldoPby   = $p->saldo_akhir;
                $NamaPby    = $p->nama;

                $PbyTag = PbyJadwal::where('id_norek', $IdRekPby)->where('angske',$Angske)->get();
                $AngsPokok  = [];
                $AngsJasa   = [];
                foreach ($PbyTag as $j) {
                    $AngsPokok  = $j->angs_pokok;
                    $AngsJasa   = $j->angs_jasa;
                }

                AutoTagihDetail::create([
                    'periode' => $Periode,
                    'tanggal' => $Tgl,
                    'id_anggota' => $IdAnggota,
                    'id_reksimpanan' => 0,
                    'id_rekpinjaman' => $IdRekPby,
                    'nominal_pokok' => $AngsPokok,
                    'nominal_jasa' => $AngsJasa,
                    'angske' => $Angske,
                    'jenis' => $NamaPby, 
                    'id_user' => $UserId
                ]);

                PbyMutasi::create([
                    'id_norek' => $IdRekPby,
                    'no_bukti' => $NoBukti,
                    'tanggal' => $Tgl,
                    'angske' => $Angske,
                    'no_rek' => $NorekPby,
                    'keterangan' => "PG Tagihan ".$KetPeriode,
                    'angs_pokok' => $AngsPokok,
                    'angs_jasa' => $AngsJasa,
                    'user_id' => $UserId
                ]);

                /// Update saldo dan jml angsuran        
                $SisaSaldo  = $SaldoPby - $AngsPokok;
                $PbyRekUpdate = PbyRekening::findorfail($IdRekPby);
                $PbyRekUpdate->update([
                    'saldo_akhir' => $SisaSaldo,
                    'angske' => $Angske+1,
                    'status' => $SisaSaldo<=0 ? 'Lunas' : 'Aktif'
                ]);
                if ($SisaSaldo<=0) {
                    DB::update("UPDATE pby_jadwal SET status = 'OK' WHERE id_norek = ?", [$IdRekPby]);
                }else{
                    /// Tandai Jadwal Angsuran        
                    DB::update("UPDATE pby_jadwal set status='OK' WHERE id_norek=? and angske=?",[$IdRekPby,$Angske]);
                }
            }
        }   
    }

    public function export_excel()
    {
        $Periode    = periodeTagihan('periode_tag');
        return Excel::download(new TagihanExport, 'Rekap Tagihan '.$Periode.' .xlsx');
    }

    public function new_autotagih()
    {
        $Periode    = periodeTagihan('periode_tag');
        $TglMulai   = periodeTagihan("tgl_mulai");
        $TglSelesai = periodeTagihan('tgl_selesai');
        $Periode= periodeTagihan('periode');

        /// Hapus Data tagihan jika sudah ada        
        DB::delete("DELETE FROM tgh_anggota_new WHERE periode=?",[$Periode]);

        /// Cari Data Anggota
        $Anggota    = MsAnggota::where('status_keanggotaan','Aktif')->get();
        foreach ($Anggota as $k) {
            AutoTagihNew::create([
                'periode' => $Periode,
                'id_anggota' => $k->id,
                'simp_pokok'=> 0,
                'simp_wajib'=>0, 
                'simp_sukarela' => 0,
                'cicilan_barang' => 0, 
                'tenor_cicil' => 0,
                'angske_cicil' => 0,
                'tenor_tunai'=>0,
                'angske_tunai'=>0,
                'pinjaman_tunai' => 0,
                'total_tagihan' => 0,
                'user_id' =>0
            ]);
        }
        foreach ($Anggota as $k) {
            $IdAnggota  = $k->id;
            ///// Cari Simpanan Anggota
            $SimpRekPokok    = SimpRekening::where('id_anggota', $IdAnggota)->where('status_aktif','Y')->where('id_simpanan', "1")->get();
            if (count($SimpRekPokok)>0){
                foreach ($SimpRekPokok as $s) {
                    $Setoran    = $s->setoran;
                    $IsSetor    = $s->is_setor;

                    if ($IsSetor == 0){
                        $NomPokok   = $Setoran; 
                                                    
                    }else{
                        $NomPokok   = 0;                           
                    }
                    
                    DB::update("update tgh_anggota_new set simp_pokok=? where id_anggota=?", [$NomPokok, $IdAnggota]);   
                }
            }

            ///// Cari Simpanan Anggota
            $SimpRekwajib    = SimpRekening::where('id_anggota', $IdAnggota)->where('status_aktif','Y')->where('id_simpanan', "2")->where('jmlskip_tagih',"0")->get();

            if (count($SimpRekwajib)>0){
                foreach ($SimpRekwajib as $w) {
                    $Setoran    = $w->setoran;
                    
                    DB::update("update tgh_anggota_new set simp_wajib=? where id_anggota=?", [$Setoran, $IdAnggota]);   
                }
            }

            // $PbyRek     = PbyRekening::where('id_anggota', $IdAnggota)->where('status','Aktif')->get();
            $PbyRek     = DB::select("SELECT r.*, p.jenis FROM pby_rekening r, pby_pengajuan p WHERE r.id_pengajuan=p.id and r.id_anggota=? and r.status=? and r.tgl_cair<=? ",[$IdAnggota,'Aktif',$TglSelesai]);
            // if ($IdAnggota ==34){
            // dd($PbyRek);
            // }
            foreach ($PbyRek as $p) {
                $IdPby  = $p->id_pinjaman;
                $IdNorek    = $p->id;
                $Angske = $p->angske;
                $Tenor  = $p->jangka;
                $JnsPinjaman    = $p->jenis;


                $PbyTag = DB::select("select (sum(angs_jasa)+sum(angs_pokok)) as Tag_pby from pby_jadwal where id_norek=? and angske=?",[$IdNorek,$Angske]);

                $TagTunai   = [];
                foreach ($PbyTag as $t) {
                    $TagTunai   = round($t->Tag_pby,0);
                }

                if ($JnsPinjaman == "Cicilan Barang") {
                    $CekPinjCicilan   = DB::select('SELECT * FROM tgh_anggota_new WHERE id_anggota=?',[$IdAnggota]);
                    $JmlCicilan   = [];
                    foreach($CekPinjCicilan as $t){
                        $JmlCicilan   = $t->cicilan_barang;
                    }
                    if ($JmlCicilan <=0){
                        DB::update("update tgh_anggota_new set cicilan_barang=?, tenor_cicil=?, angske_cicil=? where id_anggota=?", [$TagTunai, $Tenor, $Angske, $IdAnggota]);
                    }else{
                        
                        AutoTagihNew::create([
                            'periode' => $Periode,
                            'id_anggota' => $IdAnggota,
                            'simp_pokok'=> 0,
                            'simp_wajib'=>0, 
                            'simp_sukarela' => 0,
                            'cicilan_barang' => $TagTunai, 
                            'tenor_cicil' => $Tenor,
                            'angske_cicil' => $Angske,
                            'tenor_tunai'=>0,
                            'angske_tunai'=>0,
                            'pinjaman_tunai' => 0,
                            'total_tagihan' => 0,
                            'user_id' =>0
                        ]);
                    }
                    
                }else{
                    $CekPinjTunai   = DB::select('SELECT * FROM tgh_anggota_new WHERE id_anggota=?',[$IdAnggota]);
                    $JmlPinjTunai   = [];
                    foreach($CekPinjTunai as $t){
                        $JmlPinjTunai   = $t->pinjaman_tunai;
                    }
                    if ($JmlPinjTunai <=0){
                        DB::update("update tgh_anggota_new set pinjaman_tunai=?, tenor_tunai=?, angske_tunai=? where id_anggota=?", [$TagTunai, $Tenor, $Angske, $IdAnggota]);
                    }else{
                        AutoTagihNew::create([
                            'periode' => $Periode,
                            'id_anggota' => $IdAnggota,
                            'simp_pokok'=> 0,
                            'simp_wajib'=>0, 
                            'simp_sukarela' => 0,
                            'cicilan_barang' => 0, 
                            'tenor_cicil' => 0,
                            'angske_cicil' => 0,
                            'tenor_tunai'=> $Tenor,
                            'angske_tunai'=> $Angske,
                            'pinjaman_tunai' => $TagTunai,
                            'total_tagihan' => 0,
                            'user_id' =>0
                        ]);
                    }
                }
                // dd("sini");
            }
        
        }

        DB::statement("UPDATE tgh_anggota_new set total_tagihan=simp_pokok+simp_wajib+simp_sukarela+cicilan_barang+pinjaman_tunai where periode='$Periode' and id=id");

        DB::statement("DELETE FROM tgh_anggota_new where periode='$Periode' and total_tagihan<=0");
        
        $Rekap  = AutoTagihNew::where('periode',$Periode)->get();
        $TotRekap  = DB::select("SELECT sum(simp_pokok) as pokok, sum(simp_wajib) as wajib, sum(simp_sukarela) as suka, sum(cicilan_barang) as cicil, sum(pinjaman_tunai) as tunai, sum(total_tagihan) as tottag FROM tgh_anggota_new WHERE periode=?",[$Periode]);

        $TotPokok   = [];
        $TotWajib   = [];
        $TotSuka    = [];
        $PinjTunai  = [];
        $Cicilan    = [];
        $TotTagihan = [];
        foreach ($TotRekap as $k) {
            $TotPokok   = $k->pokok;
            $TotWajib   = $k->wajib;
            $TotSuka    = $k->suka;
            $PinjTunai  = $k->tunai;
            $Cicilan    = $k->cicil;
            $TotTagihan = $k->tottag;
        }

        $Data = AutoTagihNew::all();
        return view('admin.autotagih.index', compact('Rekap', 'TotPokok', 'TotWajib', 'TotSuka', 'PinjTunai', 'Cicilan', 'TotTagihan'));
    }

    public function rekap_tagihan()
    {
        return view('admin.autotagih.rekap');
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
