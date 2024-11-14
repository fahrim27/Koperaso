<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\AktMutasi;
use App\Exports\SimpananExport;
use App\Imports\SimpMutasiImport;
use App\Lib\CreateJurnal;
use App\SimpMutasi;
use App\AktSetting;
use App\ChartAccount;
use App\SimpRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\LibAkun;
use App\Lib\LibTransaksi;
use App\SimpImport;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

class SimpMutasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SimpMutasi = DB::select('select r.no_rek, t.*, a.nama_anggota, m.nama, m.akun_produk from simp_mutasi t, simp_rekening r, simp_master m, ms_anggota a where r.id_anggota=a.id and r.id_simpanan=m.id and t.id_norek=r.id order by t. tanggal DESC');

        return view('admin.simp_mutasi.index', compact('SimpMutasi'));
    }

    public function filter(Request $req)
    {
        $SimpRek = SimpRekening::findorfail($req->input('id'));
        $IdRek  = $SimpRek->id;
        $Norek      = $req->input('no_rek');
        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');
        $SimpMutasi = DB::select("select * from simp_mutasi where no_rek='$Norek' and tanggal>='$TglMulai' and tanggal<='$TglSelesai' order by tanggal, no_bukti ASC");
        $JmlMutasi  = DB::select("select sum(debet) as debet, sum(kredit) as kredit from simp_mutasi where no_rek='$Norek' and tanggal>='$TglMulai' and tanggal<='$TglSelesai' group by no_rek");

        $JmlDebet  = [];
        $JmlKredit  = [];
        
        foreach($JmlMutasi as $j){
            $JmlDebet   = $j->debet;
            $JmlKredit   = $j->kredit;
        }   

        return view('admin.simp_rekening.show', compact('SimpMutasi', 'SimpRek', 'JmlDebet', 'JmlKredit'));

    }

    public function cetak_mutasi(Request $req)
    {
        // dd($req);
        $SimpRek = SimpRekening::findorfail($req->input('id'));
        $IdRek  = $SimpRek->id;
        $Norek      = $req->input('no_rek');
        $TglMulai   = $req->input('tgl_mulai');
        $TglSelesai   = $req->input('tgl_selesai');
        $SimpMutasi = DB::select("select * from simp_mutasi where no_rek='$Norek' and tanggal>='$TglMulai' and tanggal<='$TglSelesai' order by tanggal, no_bukti ASC");
        $JmlMutasi  = DB::select("select sum(debet) as debet, sum(kredit) as kredit from simp_mutasi where no_rek='$Norek' and tanggal>='$TglMulai' and tanggal<='$TglSelesai' group by no_rek");

        $JmlDebet  = [];
        $JmlKredit  = [];
        
        foreach($JmlMutasi as $j){
            $JmlDebet   = $j->debet;
            $JmlKredit   = $j->kredit;
        }   

        return view('admin.simp_rekening.cetak_mutasi', compact('SimpMutasi', 'SimpRek', 'JmlDebet', 'JmlKredit'));
        // $url = "/koperasi_untung/admin/simp_rekening/lihat_mutasi/cetak";
        // echo "<script>window.open('".$url."', '_blank')</script>";

        // Session::flash('flash_message', $url);
        // return redirect()->back(); 

    }

    public function print_mutasi(){

    }

    public function cetak_bukti($id){
        $SimpMutasi = SimpMutasi::findorfail($id);

        return view('admin.simp_mutasi.print', compact('SimpMutasi'));
    }

    public function export_excel()
    {
        return Excel::download(new SimpananExport, 'data_simpanan.xlsx');
    }

    public function import()
    {

        return view('admin.simp_mutasi.import');
    }

    public function import_excel(Request $req)
    {
        // validasi
		$this->validate($req, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $req->file('file'); 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
		// upload ke folder file_siswa di dalam folder public
		$file->move(public_path('file_simpanan'),$nama_file);
        
		// import data
		Excel::import(new SimpMutasiImport, public_path('file_simpanan/'.$nama_file));
        DB::statement("DELETE FROM simp_mutasi");
        $DataExcel = SimpImport::all();
        // dd($DataExcel);

        foreach ($DataExcel as $k) {
            $IdRekening      = $k->id_norek;
            $Norek           = $k->no_rek;
            $JenisTrx        = $k->jenis;
            $Tgl        = Carbon::now()->format("Ymd");
            $NoBukti    = LibTransaksi::NoBukti(substr($Tgl,-6));
            $AkunKas    = LibAkun::AkunKAS();
            $SimpRek    = DB::select('select r.*, a.nama_anggota, m.nama, m.akun_produk from simp_rekening r, simp_master m, ms_anggota a where r.id_anggota=a.id and r.id_simpanan=m.id and r.id=?', [$IdRekening]);
            $NamaSimp = [];
            $NamaAgt = [];
            $Norek = [];
            $AkunSimp  = [];
            $SaldoSimp  = [];
            $Tanggal        = Carbon::now()->format("Y-m-d");

            
            foreach($SimpRek as $s){
                $NamaSimp   = $s->nama;
                $NamaAgt    = $s->nama_anggota;
                $Norek      = $s->no_rek;
                $AkunSimp   = $s->akun_produk;
                $SaldoSimp  = $s->saldo_akhir;
            }        
            
            $Nominal    = $k->nominal;
            if ($JenisTrx == 'Setor'){
                $Debet  = 0;
                $Kredit = $Nominal;            
                $Keterangan = "Setoran ".$NamaSimp." A.n ".$NamaAgt;
            }else{
                $Debet  = $Nominal;
                $Kredit = 0;            
                $Keterangan = "Penarikan ".$NamaSimp." A.n ".$NamaAgt;
            }
            

            $UserId=Auth::user()->id;;
            $AktJnsMutasi    = "Simpanan";
            SimpMutasi::create([
                'id_norek' => $IdRekening,
                'no_bukti' => $NoBukti,
                'tanggal'  => $Tgl,
                'no_rek'    => $Norek, 
                'keterangan' => $Keterangan,
                'debet' => $Debet, 
                'kredit' => $Kredit,
                'user_id' =>$UserId,
            ]);

            /// Setoran Simpanan 
            /// Kas - Debet || Akun Simp - Kredit
            CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Nominal, 'debet', $Keterangan, $AktJnsMutasi, $Tanggal);
            CreateJurnal::AktMutasi($NoBukti, $AkunSimp, $Nominal, 'kredit', $Keterangan, $AktJnsMutasi, $Tanggal);
            $UpdateSaldo = DB::update('update simp_rekening set saldo_akhir = saldo_akhir+? where no_rek = ?', [$Nominal, $Norek]);
        }


		// notifikasi dengan session
		Session::flash('flash_message', 'Data Berhasil Diimport');
        return redirect('admin/simp_mutasi');
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $SimpRek    = SimpRekening::where('status_aktif', 'Y')->get();
        $Akun = ChartAccount::orderby('kde_akun','ASC')->get();
        $AktSetting  = AktSetting::first();
        $AkunKas        = $AktSetting->akun_kas;

        return view('admin.simp_mutasi.create', compact('SimpRek', 'Akun', 'AktSetting', 'AkunKas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $this->validate($req,[
            'no_rekening' => 'required',
            'jumlah' => 'required'
        ]);
        $IdRekening      = $req->input('no_rekening');
        $Tgl        = Carbon::now()->format("Ymd");
        $NoBukti    = LibTransaksi::NoBukti(substr($Tgl,-6));
        // $AkunKas    = LibAkun::AkunKAS();
        $AkunKas    = $req->input('kde_akun');
        $JnsMutasi  = $req->input('jns_mutasi');
        $SimpRek    = DB::select('select r.*, a.nama_anggota, m.nama, m.akun_produk from simp_rekening r, simp_master m, ms_anggota a where r.id_anggota=a.id and r.id_simpanan=m.id and r.id=?', [$IdRekening]);
        $NamaSimp = [];
        $NamaAgt = [];
        $Norek = [];
        $AkunSimp  = [];
        $SaldoSimp  = [];
        
        foreach($SimpRek as $s){
            $NamaSimp   = $s->nama;
            $NamaAgt    = $s->nama_anggota;
            $Norek      = $s->no_rek;
            $AkunSimp   = $s->akun_produk;
            $SaldoSimp  = $s->saldo_akhir;
        }        
        
        $Tanggal    = Carbon::now()->format('Y-m-d');
        $Nominal    = str_replace(".","",$req->input('jumlah'));
        if ($JnsMutasi == "1"){
            $Debet  = 0;
            $Kredit = $Nominal;            
        }else{
            $Debet  = $Nominal;
            $Kredit = 0;
            if($SaldoSimp < $Nominal){
                Session::flash('error_message', 'Saldo simpanan tidak mencukupi');
                return redirect('admin/simp_mutasi');
            }
        }
        $Ket        = $req->input('keterangan');
        if ($Ket == null){
            if ($JnsMutasi == "1"){
                $Keterangan = "Setoran ".$NamaSimp." A.n ".$NamaAgt;
            }else{
                $Keterangan = "Penarikan ".$NamaSimp." A.n ".$NamaAgt;
            }
        }else{
            $Keterangan = $Ket;
        }
        $UserId=Auth::user()->id;;
        $AktJnsMutasi    = "Simpanan";
        $Mutasi   =SimpMutasi::create([
            'id_norek' => $IdRekening,
            'no_bukti' => $NoBukti,
            'tanggal'  => $Tgl,
            'no_rek'    => $Norek, 
            'keterangan' => $Keterangan,
            'debet' => $Debet, 
            'kredit' => $Kredit,
            'user_id' =>$UserId,
        ]);

        if($JnsMutasi== "1"){
            /// Setoran Simpanan 
            /// Kas - Debet || Akun Simp - Kredit
            CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Nominal, 'debet', $Keterangan, $AktJnsMutasi, $Tanggal);
            CreateJurnal::AktMutasi($NoBukti, $AkunSimp, $Nominal, 'kredit', $Keterangan, $AktJnsMutasi, $Tanggal);
            $UpdateSaldo = DB::update('update simp_rekening set saldo_akhir = saldo_akhir+? where no_rek = ?', [$Nominal, $Norek]);
        }else{
            /// Penarikan Simpanan
            /// Kas - Kredit || Akun Simp - Debet
            CreateJurnal::AktMutasi($NoBukti, $AkunSimp, $Nominal, 'debet', $Keterangan, $AktJnsMutasi, $Tanggal);
            CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Nominal, 'kredit', $Keterangan, $AktJnsMutasi, $Tanggal);
            $UpdateSaldo = DB::update('update simp_rekening set saldo_akhir = saldo_akhir-? where no_rek = ?', [$Nominal, $Norek]);
        }

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/simp_mutasi');
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
    public function destroy(Request $req)
    {
        $id = $req->input('id');
        $SimpMutasi = SimpMutasi::findorfail($id);
        $IdRek  = $SimpMutasi->id_norek;
        $Debet  = $SimpMutasi->debet;
        $Kredit = $SimpMutasi->kredit;
        $NoBukti = $SimpMutasi->no_bukti;
        $JnsTrans   = $Debet>0 ? 'Tarik' : 'Setor';

        $SimpRek    = SimpRekening::findorfail($IdRek);
        $SaldoSimp  = $SimpRek->saldo_akhir;
        if ($JnsTrans == 'Tarik'){
            $Nominal    = $Debet;
            $SaldoAkhir = $SaldoSimp+$Nominal;
        }else{
            $Nominal    = $Kredit;
            $SaldoAkhir = $SaldoSimp-$Nominal;
        }

        /// Masukkan ke tabel akt_murasirev
        $Kor =DB::statement("INSERT INTO akt_mutasirev select * from akt_mutasi where no_bukti=?", [$NoBukti]);

        /// Kembalikan saldo sebelum nya
        $SimpRek->update([
            'saldo_akhir' => $SaldoAkhir
        ]);

        /// Hapus Simp Mutasi        
        DB::delete('delete from simp_mutasi where no_bukti = ?', [$NoBukti]);

        /// Hapus Akt mutasi
        DB::delete('delete from akt_mutasi where no_bukti=?', [$NoBukti]);


        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect('admin/simp_mutasi');
    }
}
