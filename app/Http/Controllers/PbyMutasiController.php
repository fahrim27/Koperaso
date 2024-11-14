<?php

namespace App\Http\Controllers;

use App\Exports\PinjamanExport;
use App\Imports\PinjamanMutasiImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\LibAkun;
use App\Lib\LibTransaksi;
use App\PbyMaster;
use App\PbyMutasi;
use App\PbyRekening;
use App\Lib\CreateJurnal;
use App\PbyImport;
use App\PbyJadwal;
use App\ShuJasaAgt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use Maatwebsite\Excel\Facades\Excel;

use function PHPSTORM_META\map;

class PbyMutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.pby_mutasi.index');
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

    public function export_excel()
    {
        return Excel::download(new PinjamanExport, 'data_pinjaman.xlsx');

    }

    public function import_excel(Request $req){
        $this->validate($req, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $req->file('file'); 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
		// upload ke folder file_siswa di dalam folder public
		$file->move(public_path('file_pinjaman'),$nama_file);
        
		// import data
		Excel::import(new PinjamanMutasiImport, public_path('file_pinjaman/'.$nama_file));
        
        $DataExcel = PbyImport::all();
        // dd($DataExcel);

        foreach ($DataExcel as $k) {
            $IdNorek    = $k->id_norek;
            $PbyRek     = PbyRekening::findorfail($IdNorek);
            $SaldoPby   = $PbyRek->saldo_akhir;
            $LastAngs   = $PbyRek->angske;
            $Norek      = $PbyRek->no_rek;
            $IdPinjaman = $PbyRek->id_pinjaman;
            $Tgl        = Carbon::now()->format("Ymd");
            $NoBukti    = LibTransaksi::NoBukti(substr($Tgl,-6));
            $AkunKas    = LibAkun::AkunKAS();
            $Tanggal    = Carbon::now()->format("Y-m-d");

            $AngsPokok  = $k->angs_pokok;
            $AngsJasa   = $k->angs_jasa;

            /// get detail produk pinjaman
            $PbyMaster      = PbyMaster::findorfail($IdPinjaman);
            $AkunPby        = $PbyMaster->akun_produk;
            $AkunJasa       = $PbyMaster->akun_jasa;
            $UserId         = Auth::user()->id;
            $Keterangan     = "Angsuran Pinjaman A.n ".$PbyRek->Anggota->nama_anggota;


            /// Rekap ke mutasi
            PbyMutasi::create([
                'id_norek' => $IdNorek,
                'no_bukti' => $NoBukti,
                'tanggal' => $Tanggal,
                'no_rek' => $Norek,
                'keterangan' => $Keterangan,
                'angs_pokok' => $AngsPokok,
                'angs_jasa' => $AngsJasa,
                'user_id' => $UserId
            ]);

            /// Update saldo dan jml angsuran
            $SisaSaldo  = $SaldoPby - $AngsPokok;
            $JmlAngs    = $LastAngs+1;
            $PbyRek->update([
                'saldo_akhir' => $SisaSaldo,
                'angske' => $JmlAngs
            ]);

            /// Tandai Jadwal Angsuran        
            DB::update("update pby_jadwal set status = 'OK' where id_norek = ? and angske = ?", [$IdNorek, $LastAngs]);
            

            /// Catat di Akunting
            /// KAS - Debet || Akun Pinjaman - Kredit || Akun Pendptan Jasa - Kredit
            $Nominal    = $AngsPokok+$AngsJasa;

            // Jurnal Angsuran
            CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Nominal, 'debet', $Keterangan, 'Angsuran', $Tanggal );
            CreateJurnal::AktMutasi($NoBukti, $AkunPby, $AngsPokok, 'kredit', $Keterangan, 'Angsuran', $Tanggal );
            CreateJurnal::AktMutasi($NoBukti, $AkunJasa, $AngsJasa, 'kredit', $Keterangan, 'Angsuran', $Tanggal );
        }
        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/pby_rekening');
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
            'ang_pokok' => 'required',
            'ang_jasa' => 'required'
        ]);

        $IdNorek    = $req->input('id_norek');
        $PbyRek     = PbyRekening::findorfail($IdNorek);
        $IdAnggota  = $PbyRek->id_anggota;
        $SaldoPby   = $PbyRek->saldo_akhir;
        $LastAngs   = $PbyRek->angske;
        $LastAngs2   = $PbyRek->angske;
        $Norek      = $PbyRek->no_rek;
        $IdPinjaman = $req->input('idpinjaman');
        $Tgl        = Carbon::now()->format("Ymd");
        $NoBukti    = LibTransaksi::NoBukti(substr($Tgl,-6));
        $AkunKas    = LibAkun::AkunKAS();
        $Tanggal    = Carbon::now()->format("Y-m-d");

        $NomPokok   = str_replace(".","",$req->input('ang_pokok'));
        $NomJasa    = str_replace(".","",$req->input('ang_jasa'));
        $Sisa       = $NomPokok;
        do {
            $PbyJadwal = PbyJadwal::where('id_norek',$IdNorek)->where('angske', $LastAngs)->get();
            $TagPokok = [];
            foreach ($PbyJadwal as $k){
               $TagPokok = $k->tag_pokok;
            }
            
            if ($TagPokok >0 && $Sisa>$TagPokok) {
                $Sisa  = $Sisa-$TagPokok;
                $AngsPokok = $TagPokok;
                DB::update("UPDATE pby_jadwal SET tag_pokok=tag_pokok-? WHERE id_norek=? AND angske=?",[$AngsPokok,$IdNorek,$LastAngs]);
            }else{
                $AngsPokok = $Sisa;
                $Sisa  = 0;                
                DB::update("UPDATE pby_jadwal SET tag_pokok=tag_pokok-? WHERE id_norek=? AND angske=?",[$AngsPokok,$IdNorek,$LastAngs]);
            }     
            $LastAngs++;       
        } while ($Sisa >0);

        $SisaJasa       = $NomJasa;
        do {
            $PbyJadwal = PbyJadwal::where('id_norek',$IdNorek)->where('angske', $LastAngs2)->get();
            $TagJasa = [];
            foreach ($PbyJadwal as $k){
               $TagJasa = $k->tag_jasa;
            }
            
            if ($TagJasa >0 && $SisaJasa>$TagJasa) {
                $SisaJasa  = $SisaJasa-$TagJasa;
                $AngsJasa = $TagJasa;
                DB::update("UPDATE pby_jadwal SET tag_jasa=tag_jasa-? WHERE id_norek=? AND angske=?",[$AngsJasa,$IdNorek,$LastAngs2]);
            }else{
                $AngsJasa = $SisaJasa;
                $SisaJasa  = 0;                
                DB::update("UPDATE pby_jadwal SET tag_jasa=tag_jasa-? WHERE id_norek=? AND angske=?",[$AngsJasa,$IdNorek,$LastAngs2]);
            }     
            $LastAngs2++;       
        } while ($SisaJasa >0);

        /// get detail produk pinjaman
        $PbyMaster      = PbyMaster::findorfail($IdPinjaman);
        $AkunPby        = $PbyMaster->akun_produk;
        $AkunJasa       = $PbyMaster->akun_jasa;
        $UserId         = Auth::user()->id;
        $Keterangan     = "Angsuran Pinjaman A.n ".$PbyRek->Anggota->nama_anggota;
        $AngsPokok   = str_replace(".","",$req->input('ang_pokok'));
        $AngsJasa    = str_replace(".","",$req->input('ang_jasa'));


        /// Rekap ke mutasi
        PbyMutasi::create([
            'id_norek' => $IdNorek,
            'no_bukti' => $NoBukti,
            'tanggal' => $Tanggal,
            'angske' => $PbyRek->angske,
            'no_rek' => $Norek,
            'keterangan' => $Keterangan,
            'angs_pokok' => $AngsPokok,
            'angs_jasa' => $AngsJasa,
            'user_id' => $UserId
        ]);

        /// Update saldo dan jml angsuran
        
        $SisaSaldo  = $SaldoPby - $AngsPokok;
        $JmlAngs    = $LastAngs;
        $PbyRek->update([
            'saldo_akhir' => $SisaSaldo,
            'angske' => $JmlAngs,
            'status' => $SisaSaldo<=0 ? 'Lunas' : 'Aktif'
        ]);
        if ($SisaSaldo<=0) {
            DB::update("UPDATE pby_jadwal SET status = 'OK' WHERE id_norek = ?", [$IdNorek]);
        }else{
            /// Tandai Jadwal Angsuran        
            DB::update("UPDATE pby_jadwal SET status = 'OK' WHERE tag_pokok<=? AND tag_jasa<=? AND id_norek = ?", [0,0,$IdNorek]);
        }



        /// Masukkan ke transaksi JASA utk perhitungan SHU
        // ShuJasaAgt::create([
        //     'id_anggota' => $IdAnggota,
        //     'no_trx' => $NoBukti,
        //     'tanggal' => $Tanggal,
        //     'hpp' => 0,
        //     'harga_jual' => 0,
        //     'nominal' => $AngsJasa
        // ]);
        

        /// Catat di Akunting
        /// KAS - Debet || Akun Pinjaman - Kredit || Akun Pendptan Jasa - Kredit
        $Nominal    = $AngsPokok+$AngsJasa;

        // // Jurnal Angsuran
        // CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Nominal, 'debet', $Keterangan, 'Angsuran');
        // CreateJurnal::AktMutasi($NoBukti, $AkunPby, $AngsPokok, 'kredit', $Keterangan, 'Angsuran');
        // CreateJurnal::AktMutasi($NoBukti, $AkunJasa, $AngsJasa, 'kredit', $Keterangan, 'Angsuran');

        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/pby_rekening');
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
        $PbyMutasi  = PbyMutasi::findorfail($id);
        $NoBukti    = $PbyMutasi->no_bukti;
        $AngsPokok  = $PbyMutasi->angs_pokok;
        $Angske     = $PbyMutasi->angske;
        $LastAngs     = $PbyMutasi->angske;
        $LastAngs2     = $PbyMutasi->angske;
        $PbyRekening    = PbyRekening::findorfail($PbyMutasi->id_norek);
        $IdNorek        = $PbyRekening->id;
        $SisaSaldo      = $PbyRekening->saldo_akhir+$AngsPokok;

        $NomPokok   = $PbyMutasi->angs_pokok;
        $NomJasa    = $PbyMutasi->angs_jasa;
        $Sisa       = $NomPokok;
        do {
            $PbyJadwal = PbyJadwal::where('id_norek',$IdNorek)->where('angske', $LastAngs)->get();
            $TagPokok = [];
            foreach ($PbyJadwal as $k){
               $TagPokok = $k->angs_pokok;
            }
            
            if ($TagPokok >0 && $Sisa>$TagPokok) {
                $Sisa  = $Sisa-$TagPokok;
                $AngsPokok = $TagPokok;
                DB::update("UPDATE pby_jadwal SET tag_pokok=tag_pokok+? WHERE id_norek=? AND angske=?",[$AngsPokok,$IdNorek,$LastAngs]);
            }else{
                $AngsPokok = $Sisa;
                $Sisa  = 0;                
                DB::update("UPDATE pby_jadwal SET tag_pokok=tag_pokok+? WHERE id_norek=? AND angske=?",[$AngsPokok,$IdNorek,$LastAngs]);
            }     
            $LastAngs++;       
        } while ($Sisa >0);

        $SisaJasa       = $NomJasa;
        do {
            $PbyJadwal = PbyJadwal::where('id_norek',$IdNorek)->where('angske', $LastAngs2)->get();
            $TagJasa = [];
            foreach ($PbyJadwal as $k){
               $TagJasa = $k->angs_jasa;
            }
            
            if ($TagJasa >0 && $SisaJasa>$TagJasa) {
                $SisaJasa  = $SisaJasa-$TagJasa;
                $AngsJasa = $TagJasa;
                DB::update("UPDATE pby_jadwal SET tag_jasa=tag_jasa+? WHERE id_norek=? AND angske=?",[$AngsJasa,$IdNorek,$LastAngs2]);
            }else{
                $AngsJasa = $SisaJasa;
                $SisaJasa  = 0;                
                DB::update("UPDATE pby_jadwal SET tag_jasa=tag_jasa+? WHERE id_norek=? AND angske=?",[$AngsJasa,$IdNorek,$LastAngs2]);
            }     
            $LastAngs2++;       
        } while ($SisaJasa >0);

        
        ///// Hapus Mutasi
        $PbyMutasi->delete();

        /// Update status jadwal pembayaran    
        DB::update("UPDATE pby_jadwal SET status='' WHERE id_norek=? and tag_pokok>?",[$IdNorek, 0]);

        $PbyRekening->update([
            'saldo_akhir' => $SisaSaldo,
            'status' => 'Aktif',
            'angske' => $Angske
        ]);

        //// Hapus rekap jasa anggota
        DB::delete("DELETE FROM shu_jasaagt WHERE no_trx=?",[$NoBukti]);
        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect()->back();     

    }
}
