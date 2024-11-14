<?php

namespace App\Http\Controllers;

use App\AktMutasi;
use App\ChartAccount;
use App\Lib\CreateJurnal;
use App\Lib\LibAkun;
use App\Lib\LibTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KasMutasiController extends Controller
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
        $KasMutasi = DB::select("SELECT t.tanggal, t.no_bukti, t.kde_akun, a.nma_akun, a.pos_akun, t.keterangan, t.debet, t.kredit, t.id FROM chart_account a, akt_mutasi t WHERE t.kde_akun=a.kde_akun and t.jns_mutasi='MutasiKas' order by t.tanggal DESC");

        return view('admin.mutasi_kas.index', compact('KasMutasi'));

    }

    /**
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Akun = ChartAccount::orderby('kde_akun','ASC')->get();
        // dd($Akun);

        return view('admin.mutasi_kas.create', compact('Akun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $this->validate($req, [
            'kde_akun' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required'
        ]);

        $JnsMutasi  = "MutasiKas";
        $KdeAkun    = $req->input('kde_akun');
        $Nominal    = str_replace(".","",$req->jumlah);
        $Keterangan = $req->input('keterangan');
        $Tgl        = Carbon::now()->format('Ymd');
        $NoBukti    = LibTransaksi::NoBukti(substr($Tgl,-6));
        $AkunKas    = LibAkun::AkunKAS();

        $Tanggal    = $req->input('tanggal');

        if($req->input('jns_mutasi') == "1"){
            /// Kas Keluar
            CreateJurnal::AktMutasi($NoBukti, $KdeAkun, $Nominal, 'debet', $Keterangan, $JnsMutasi, $Tanggal  );
            CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Nominal, 'kredit', $Keterangan, $JnsMutasi, $Tanggal  );
        }else{
            /// Kas Masuk
            CreateJurnal::AktMutasi($NoBukti, $AkunKas, $Nominal, 'debet', $Keterangan, $JnsMutasi, $Tanggal  );
            CreateJurnal::AktMutasi($NoBukti, $KdeAkun, $Nominal, 'kredit', $Keterangan, $JnsMutasi, $Tanggal  );
        }
        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/mutasi_kas');
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
        return redirect('admin/mutasi_kas');
    }
}
