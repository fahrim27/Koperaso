<?php

namespace App\Http\Controllers;

use App\Lib\LibRekening;
use App\Lib\LibTransaksi;
use App\MsAnggota;
use App\Lib\LibMaster;
use App\Mail\VerifikasiAnggotaMail;
use App\MsDepartment;
use App\MsJabatan;
use App\Models\User;
use App\MsPerusahaan;
use App\PbyRekening;
use App\SimpMaster;
use App\SimpRekening;
use Illuminate\Http\Request;
use PDF;
use Mail;
use Session;


class MsAnggotaController extends Controller
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
        $Anggota = MsAnggota::where('status_keanggotaan','Aktif')->get();
        $AnggotaNonAktif = MsAnggota::where('status_keanggotaan','Non-Aktif')->get();

        $Perush     = MsPerusahaan::all();

        return view('admin.ms_anggota.index', compact('Anggota', 'AnggotaNonAktif', 'Perush'));
    }

    public function filter(Request $req)
    {
        $Perush     = MsPerusahaan::all();
        $Anggota    = MsAnggota::where('status_keanggotaan', 'Aktif')->where('id_perusahaan', $req->input('idperush'))->get();

        return view('admin.ms_anggota.index', compact('Anggota', 'Perush'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Perush     = MsPerusahaan::all();
        $Department = MsDepartment::all();
        $Jabatan    = MsJabatan::all();
        return view('admin.ms_anggota.create', compact('Perush', 'Department', 'Jabatan'));
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
            'nik' => 'required',
            'nama' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'perusahaan' => 'required',
            'department' => 'required',
            'sts_karyawan' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,jpeg,png|max:2000'            
        ]);

        if ($req->hasfile('filename')) {            
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$req->file('filename')->getClientOriginalName());
            $req->file('filename')->move(public_path('images'), $filename);
        }
        // dd($req);

        $Nik    = $req->input('nik');
        $Nama   = $req->input('nama');
        $Email  = $req->input('email');
        $Password   = bcrypt($req->input('password'));
        $JnsKel     = $req->input('jenkel');
        $TmpLahir   = $req->input('tempat_lahir');
        $TglLahir   = $req->input('tgl_lahir');
        $Perusahaan = $req->input('perusahaan');
        $Department = $req->input('department');
        $StsKaryawan= $req->input('sts_karyawan');
        $Alamat     = $req->input('alamat');
        $NoKtp      = $req->input('ktp');
        $NoTelpon   = $req->input('telpon');
        $RekBank    = $req->input('rek_bank');
        $Jabatan    = $req->input('jabatan');
        $Domisili   = $req->input('domisili');
        $Telp2      = $req->input('kontak_darurat');

        $MsPerush   = MsPerusahaan::findorfail($Perusahaan);
        
        $NoAnggota = LibTransaksi::NoAnggota($MsPerush->inisial);


        $User = User::create([
            'name' => $Nama,
            'email' => $Email,
            'password' => $Password,
            'role' => 'Anggota'
        ]);
        
        $IdAnggota =MsAnggota::create([
            'user_id' => intval($User->id),
            'no_anggota' => $NoAnggota, 
            'nik' => $Nik,
            'nama_anggota' => $Nama,
            'email' => $Email, 
            'id_perusahaan' => $Perusahaan, 
            'no_ktp' =>$NoKtp,
            'id_department' => $Department, 
            'tempat_lahir' => $TmpLahir, 
            'tgl_lahir' => $TglLahir, 
            'no_telpon' => $NoTelpon,
            'jenis_kelamin' => $JnsKel, 
            'status_karyawan' => $StsKaryawan, 
            'no_rekening' => $RekBank, 
            'id_jabatan' =>$Jabatan, 
            'foto_ktp' => $filename, 
            'alamat' => $Alamat, 
            'alamat_domisili' => $Domisili,
            'kontak_darurat' =>$Telp2,
            'status_keanggotaan' => 'Aktif'
        ]);

        $SimpMaster = SimpMaster::where('modal','Y')->get();
        foreach ($SimpMaster as $k) {
            $Kode   = $k->kode;
            LibRekening::CreateRekSimp($IdAnggota->id,$Kode, intval($User->id));
        }
        Session::flash('flash_message', 'Data Berhasil Ditambahkan');
        return redirect('admin/master_anggota');
    }

    public function verifikasi_index()
    {
        if (userHelpers('department')!= "HR" && userHelpers('department')!= "ADMIN")
        {
            return redirect('admin/master_anggota');
        }
        $Anggota = MsAnggota::where('status_keanggotaan','Menunggu')->get();
        $Perush     = MsPerusahaan::all();

        return view('admin.ms_anggota.verif_index', compact('Anggota', 'Perush'));
    }

    public function verifikasi(Request $req)
    {
        $id = $req->input('id');
        $Anggota = MsAnggota::findorfail($id);
        $UserId = $Anggota->user_id;
        
        $Anggota->update([
            'status_keanggotaan' => 'Aktif'
        ]);

        $SimpMaster = SimpMaster::where('modal','Y')->get();
        foreach ($SimpMaster as $k) {
            $Kode   = $k->kode;
            LibRekening::CreateRekSimp($id,$Kode, $UserId);
        }   

        /// Kirim Notif email ke pengurus
        $MsAnggota = MsAnggota::findorfail($id);
        $EmlAnggota=  $MsAnggota->email;
        $urlAdmin    = env("APP_URL").'/login';
        $data = [
            'url' => $urlAdmin,
            'nik' => $MsAnggota->nik,
            'nama_anggota' => $MsAnggota->nama_anggota,
            'body' => 'Registrasi Anggota'
        ];
        
        if(companySetting("notif_email") == 1){
            Mail::to($EmlAnggota)->send(new VerifikasiAnggotaMail($data));
        }
        
        Session::flash('flash_message', 'Anggota telah diverifikasi');
        return redirect('admin/verifikasi_anggota');
    }

    public function nonaktif(Request $req)
    {
        $id = $req->input('id');
        $Anggota = MsAnggota::findorfail($id);
        $UserId = $Anggota->user_id;
        
        $Anggota->update([
            'status_keanggotaan' => 'Non-Aktif'
        ]);

       
        Session::flash('flash_message', 'Anggota telah dinonaktifkan');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $MsAnggota  = MsAnggota::findorfail($id);
        
        return view('admin.ms_anggota.show', compact('MsAnggota'));
    }

    public function cetakformulir($id)
    {

        $MsAnggota  = MsAnggota::findorfail($id);
        // $pdf = PDF::loadview('admin.ms_anggota.print',['MsAnggota'=>$MsAnggota]);
    	// return $pdf->download('laporan-pegawai-pdf');
        
        return view('admin.ms_anggota.print', compact('MsAnggota'));
    }
    public function download($id)
    {
        $MsAnggota  = MsAnggota::findorfail($id);
        $Nama       = $MsAnggota->nama_anggota;
        $pdf = PDF::loadview('admin.ms_anggota.print',['MsAnggota'=>$MsAnggota]);
    	return $pdf->download('Formulir-Pendaftaran-'.$Nama.'.pdf');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Perush     = MsPerusahaan::all();
        $Department = MsDepartment::all();
        $Jabatan    = MsJabatan::all();
        $Anggota    = MsAnggota::findorfail($id);

        return view('admin.ms_anggota.edit', compact('Anggota','Perush', 'Department', 'Jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
 
        $this->validate($req, [
            'nik' => 'required',
            'nama' => 'required',
            'perusahaan' => 'required',
            'department' => 'required',
            'sts_karyawan' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',     
        ]);
        
        $id     = $req->input('id_anggota');
        $Nik    = $req->input('nik');
        $Nama   = $req->input('nama');
        $JnsKel     = $req->input('jenkel');
        $TmpLahir   = $req->input('tempat_lahir');
        $TglLahir   = $req->input('tgl_lahir');
        $Perusahaan = $req->input('perusahaan');
        $Department = $req->input('department');
        $StsKaryawan= $req->input('sts_karyawan');
        $Alamat     = $req->input('alamat');
        $NoKtp      = $req->input('ktp');
        $NoTelpon   = $req->input('telpon');
        $RekBank    = $req->input('rek_bank');
        $Jabatan    = $req->input('jabatan');
        $Domisili   = $req->input('domisili');
        $Telp2      = $req->input('kontak_darurat');


        $MsAnggota = MsAnggota::findorfail($id);

        
        $MsAnggota->update([
            'nik' => $Nik,
            'nama_anggota' => $Nama,
            'id_perusahaan' => $Perusahaan, 
            'no_ktp' =>$NoKtp,
            'id_department' => $Department, 
            'tempat_lahir' => $TmpLahir, 
            'tgl_lahir' => $TglLahir, 
            'no_telpon' => $NoTelpon,
            'jenis_kelamin' => $JnsKel, 
            'status_karyawan' => $StsKaryawan, 
            'no_rekening' => $RekBank, 
            'id_jabatan' =>$Jabatan, 
            'alamat' => $Alamat, 
            'alamat_domisili' => $Domisili,
            'kontak_darurat' =>$Telp2,
        ]);

        Session::flash('flash_message', 'Data Berhasil Diperbarui');
        return redirect('admin/master_anggota');
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
        $MsAnggota  = MsAnggota::findorfail($id);

        $CekSimp    = SimpRekening::where('id_anggota', $id)->get();
        if ($CekSimp->count()>=1){
            Session::flash('error_message', 'Anggota tersebut sudah memiliki rekening simpanan');
            return redirect()->back();     
        }
        $CekPby    = PbyRekening::where('id_anggota', $id)->get();
        if ($CekPby->count()>=1){
            Session::flash('error_message', 'Anggota tersebut sudah memiliki rekening pinjaman');
            return redirect()->back();     
        }

        $MsAnggota->delete();

        Session::flash('flash_message', 'Data Berhasil Dihapus');
        return redirect('admin/master_anggota');
    }
}
