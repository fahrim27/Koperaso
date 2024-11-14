<?php

namespace App\Http\Controllers;

use App\ChartAccount;
use App\AktMutasi;
use App\Lib\CreateJurnal;
use App\Lib\LibAkun;
use App\Lib\LibTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MutasiNonKasController extends Controller
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
        $Bln = Carbon::now()->format('m');
        $Thn  = Carbon::now()->format('Y');
        $Memo = DB::select("SELECT t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.keterangan, t.debet, t.kredit, t.id FROM chart_account a, akt_mutasi t WHERE t.kde_akun=a.kde_akun and t.jns_mutasi='NonKas' AND MONTH(t.tanggal)=? AND YEAR(t.tanggal)=? order by t.no_bukti DESC",[$Bln,$Thn]);

        return view('admin.mutasi_nonkas.index', compact('Memo', 'Bln', 'Thn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AkunKas    = LibAkun::AkunKAS();
        $Akun = ChartAccount::orderby('kde_akun','ASC')->get();
        $Bln = Carbon::now()->format('m');
        $Thn  = Carbon::now()->format('y');
        $PrefixNo = "MM".$Bln.$Thn;
        $MaxNo  = LibTransaksi::getNoUrutMemo($PrefixNo);
        $AktDetail = [];
        //MENGAMBIL DATA DARI COOKIE
        $AktDetail = json_decode(request()->cookie('memo-detail'), true);

        //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        $subtotal = collect($AktDetail)->sum(function($q) {
            return $q['jumlah_kredit']; //SUBTOTAL
        });
        //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL

        return view('admin.mutasi_nonkas.create', compact('Akun', 'AktDetail', 'subtotal', 'PrefixNo', 'MaxNo'));
    }

    private function getDetailMemo(){
        $MemoDet = json_decode(request()->cookie('memo-detail'), true);
        $MemoDet = $MemoDet != '' ? $MemoDet:[];
        return $MemoDet;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if($req->input('btnType')=="btnAddDetail" || $req->input('btnType')=="btnHapus"){
            if($req->input('btnType')=="btnAddDetail") {
                $this->validate($req,[
                    'akun_kredit' => 'required',
                    'jumlah_kredit' => 'required'
                ]);

                $AktDetail = json_decode($req->cookie('memo-detail'), true);
                if ($AktDetail && array_key_exists($req->akun_kredit, $AktDetail)) {
                    Session::flash('error_message', 'Akun sudah ada, periksa kembali');
                    return redirect()->back()->withInput();
                } else {
                    $Akun = ChartAccount::where('kde_akun',$req->akun_kredit)->get();
                    $NamaAkun = [];
                    foreach ($Akun as $k) {
                        $NamaAkun = $k->nma_akun;
                    }

                    $AktDetail[$req->akun_kredit] = [
                        'akun_kredit' => $req->akun_kredit,
                        'nama_akun' => $NamaAkun,
                        'jumlah_kredit' => str_replace(".","",$req->jumlah_kredit),
                    ];
                }

                //BUAT COOKIE-NYA DENGAN NAME DW-CARTS
                //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
                $cookie = cookie('memo-detail', json_encode($AktDetail), 60);
                //STORE KE BROWSER UNTUK DISIMPAN
                return redirect()->back()->cookie($cookie)->withInput();
            } else {
                $AktDetail = json_decode($req->cookie('memo-detail'), true);
                unset($AktDetail[$req->input('kode')]);
                $cookie = cookie('memo-detail', json_encode($AktDetail), 60);
                //STORE KE BROWSER UNTUK DISIMPAN
                return redirect()->back()->cookie($cookie)->withInput();
            }
        }else{
            $this->validate($req, [
                'akun_debet' => 'required',
                'jumlah' => 'required'
            ]);
            $AktDetail = json_decode($req->cookie('memo-detail'), true);

            if ($AktDetail == null) {
                Session::flash('error_message', 'Detail akun belum ditentukan');
                return redirect()->back()->withInput();
            }
            $Bln = Carbon::now()->format('m');
            $Thn  = Carbon::now()->format('y');
            $NoBukti    = "MM".$Bln.$Thn.$req->input('no_transaksi');
            $JnsMutasi  = "NonKas";
            $JnsTrx     = $req->input('jns_mutasi');
            $AkunDebet  = $req->input('akun_debet');
            $AkunKredit  = $req->input('akun_kredit');
            $Nominal    = str_replace(".","",$req->jumlah);
            $Keterangan = $req->input('keterangan');
            $Tanggal    = $req->input('tanggal');
            $AktDetail = $this->getDetailMemo();
            $Subtotal = collect($AktDetail)->sum(function($q) {
                return $q['jumlah_kredit'];
            });
            /// PERIKSA JUMLAH TOTAL DEBET DAN KREDIT SAMA
            if ($Subtotal != $Nominal) {
                Session::flash('error_message', 'Total nominal debet dan kredit harus sama');
                return redirect()->back()->withInput();
            }

            $CekTrx = AktMutasi::where('no_bukti', $NoBukti)->get();
            if (count($CekTrx)>0){
                Session::flash('error_message', 'No. Transaksi sudah dipakai, silahkan ganti dengan yang lain');
                return redirect()->back()->withInput();
            }


            DB::beginTransaction();
            try {
                if ($JnsTrx == "1") {
                    $KdeAkun = $AkunDebet;
                    $Tipe    = "db-kr";
                }else{
                    $KdeAkun = $AkunDebet;
                    $Tipe    = "kr-db";
                }

                if ($Tipe == "db-kr") {
                    $KetTrxDb = "debet";
                    $KetTrxKr = "kredit";
                } else {
                    $KetTrxDb = "kredit";
                    $KetTrxKr = "debet";
                }

                /// Akun Induk Trx
                CreateJurnal::AktMutasi($NoBukti, $KdeAkun, $Nominal, $KetTrxDb, $Keterangan, $JnsMutasi, $Tanggal);

                //AMBIL DATA DETAIL TRX
                $AktDetail = $this->getDetailMemo();
                /// Looping Akun Trx Detail
                //LOOPING DATA DI CARTS
                foreach ($AktDetail as $row) {
                    $KdeAkunDet = $row['akun_kredit'];
                    $NomDet     = $row['jumlah_kredit'];

                    //SIMPAN DETAIL AKUN
                    CreateJurnal::AktMutasi($NoBukti, $KdeAkunDet, $NomDet, $KetTrxKr, $Keterangan, $JnsMutasi, $Tanggal);
                }
                //TIDAK TERJADI ERROR, MAKA COMMIT DATANYA UNTUK MENINFORMASIKAN BAHWA DATA SUDAH FIX UNTUK DISIMPAN
                DB::commit();

                $AktDetail = [];
                //KOSONGKAN DATA KERANJANG DI COOKIE
                $cookie = cookie('memo-detail', json_encode($AktDetail), 60);

                //REDIRECT KE HALAMAN TRANSAKSI MEMO
                Session::flash('flash_message', 'Data Berhasil Ditambahkan');
                return redirect('admin/memorial')->cookie($cookie);
            } catch (\Throwable $e) {
                //JIKA TERJADI ERROR, MAKA ROLLBACK DATANYA
                DB::rollback();
                //DAN KEMBALI KE FORM TRANSAKSI SERTA MENAMPILKAN ERROR
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }




        }
    }

    public function add_detail(Request $req){
        $this->validate($req,[
            'akun_kredit' => 'required',
            'jumlah_kredit' => 'required'
        ]);

        //AMBIL DATA CART DARI COOKIE, KARENA BENTUKNYA JSON MAKA KITA GUNAKAN JSON_DECODE UNTUK MENGUBAHNYA MENJADI ARRAY
        $AktDetail = json_decode($req->cookie('memo-detail'), true);

        //CEK JIKA CARTS TIDAK NULL DAN PRODUCT_ID ADA DIDALAM ARRAY CARTS
        if ($AktDetail && array_key_exists($req->akun_kredit, $AktDetail)) {
            Session::flash('erorr_message', 'Akun sudah ada.');
            return redirect()->back();
        } else {
            $carts[$req->akun_kredit] = [
                'jumlah_kredit' => $req->qty,
                'akun_kredit' => $req->akun_kredit,
            ];
        }

        //BUAT COOKIE-NYA DENGAN NAME DW-CARTS
        //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
        $cookie = cookie('memo-detail', json_encode($AktDetail), 2880);
        //STORE KE BROWSER UNTUK DISIMPAN
        return redirect()->back()->cookie($cookie);
    }

    public function listDetailMemo(){
        //MENGAMBIL DATA DARI COOKIE
        $AktDetail = json_decode(request()->cookie('memo-detail'), true);
        //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        $subtotal = collect($AktDetail)->sum(function($q) {
            return $q['jumlah_kredit']; //SUBTOTAL TERDIRI DARI QTY * PRICE
        });
        //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL
        return view('admin.mutasi_nonkas.create', compact('AktDetail', 'subtotal'));
    }

    public function hapus_detail(Request $req){
        dd($req->input('id'));
    }

    public function filter(Request $req){
        $this->validate($req,[
            'bulan' => 'required',
            'tahun' => 'required'
        ]);

        $Bln    = $req->input('bulan');
        $Thn    = $req->input('tahun');
        $Memo = DB::select("SELECT t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.keterangan, t.debet, t.kredit, t.id FROM chart_account a, akt_mutasi t WHERE t.kde_akun=a.kde_akun and t.jns_mutasi='NonKas' AND MONTH(t.tanggal)=? AND YEAR(t.tanggal)=? order by t.no_bukti DESC",[$Bln,$Thn]);

        return view('admin.mutasi_nonkas.index', compact('Memo', 'Bln', 'Thn'));

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
        $id     = $req->input('id');

        $KasMutasi  = AktMutasi::findorfail($id);
        $NoBukti    = $KasMutasi->no_bukti;

        /// Masukkan ke tabel akt_murasirev
        $Kor =DB::statement("INSERT INTO akt_mutasirev select * from akt_mutasi where no_bukti=?", [$NoBukti]);

        /// Hapus Akt mutasi
        DB::delete('delete from akt_mutasi where no_bukti=?', [$NoBukti]);

        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect('admin/memorial');
    }
}
