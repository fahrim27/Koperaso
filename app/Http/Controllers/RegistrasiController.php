<?php

namespace App\Http\Controllers;

use App\Lib\LibMaster;
use App\Lib\LibNotification;
use Illuminate\Http\Request;
use App\Lib\LibRekening;
use App\Lib\LibTransaksi;
use App\Mail\RegistrasiAnggotaMail;
use App\MsAnggota;
use App\MsDepartment;
use App\MsJabatan;
use App\Models\User;
use App\MsPerusahaan;
use App\SimpMaster;
use App\SysPengurus;
use Mail;
use Session;
use Illuminate\Support\Facades\DB;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Perush     = MsPerusahaan::all();
        $Department = MsDepartment::all();
        $Jabatan    = MsJabatan::all();
        return view('anggota.registrasi.create', compact('Perush', 'Department', 'Jabatan'));
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
    public function store(Request $req)
    {
        
        $this->validate($req, [
            // 'nik' => 'required',
            'nama' => 'required',
            'email' => 'required | email',
            'password' => 'required|string|min:6',
            'perusahaan' => 'required',
            'department' => 'required',
            'sts_karyawan' => 'required',
            'jabatan' => 'required',
            'telpon' => 'required',
            'kontak_darurat' => 'required',
            'alamat' => 'required',
            'domisili' => 'required',
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,jpeg,png|max:2000',  
            // 'confirm1' => 'required',
            // 'confirm2' => 'required',
        ]);

        if (($req->confirm1==null) && ($req->confirm2==null)){
            Session::flash('error_message', 'Checklist Syarat dan ketentuan pendaftaran anggota');
            return redirect()->back();     
        }

        if ($req->hasfile('filename')) {            
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$req->file('filename')->getClientOriginalName());
            $req->file('filename')->move(public_path('images'), $filename);
        }

        $Nik    = '-';
        // $req->input('nik');
        $Nama   = ucwords(strtolower($req->input('nama')));
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

        $CekUser    = User::where('email',$Email)->get();
        if(count($CekUser)>0){
            Session::flash('error_message', 'Email sudah terdaftar');
            return redirect()->back()->withInput();
        }

        $CekNIK    = MsAnggota::where('no_ktp',$NoKtp)->get();
        if(count($CekNIK)>0){
            Session::flash('error_message', 'NIK sudah terdaftar');
            return redirect()->back()->withInput();
        }

        $User = User::create([
            'name' => $Nama,
            'email' => $Email,
            'password' => $Password,
            'role' => 'Anggota',
            'department' => 'AGT',
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
            'status_keanggotaan' => 'Menunggu'
        ]);

        /// Kirim Notif email ke pengurus
        $MsAnggota = MsAnggota::findorfail($IdAnggota->id);
        // $Email  = $MsAnggota->email;
        $urlAdmin    = env("APP_URL").'/admin/master_anggota/verifikasi_anggota';
        $data = [
            'url' => $urlAdmin,
            'nik' => $MsAnggota->nik,
            'nama' => $MsAnggota->nama_anggota,
            'perusahaan' => $MsAnggota->Perusahaan->nama." - ".$MsAnggota->Department->nama,
            'status_karyawan' => $MsAnggota->status_karyawan,
            'jenis_kelamin' => $MsAnggota->jenis_kelamin,
            'tempat_lahir' => $MsAnggota->tempat_lahir,
            'tgl_lahir' => $MsAnggota->tgl_lahir,
            'email' => $MsAnggota->email,
            'no_telpon'=> $MsAnggota->no_telpon,
            'alamat' => $MsAnggota->alamat,
            'alamat_domisili' => $MsAnggota->alamat_domisili,
            'body' => 'Registrasi Anggota'
            ];

        $EmailKetua = LibMaster::getPengurus('Ketua');
        $EmailSekr = LibMaster::getPengurus('Sekretaris');
        $EmailBend = LibMaster::getPengurus('Bendahara');
        
        if(companySetting("notif_email") == 1){
            Mail::to($EmailKetua)->cc([$EmailSekr, $EmailBend])->send(new RegistrasiAnggotaMail($data));
        }
        
        $Ket    = 'Mendaftar Sebagai Anggota';
        // $UserAdmin  = User::where('role','Admin')->get();
        // foreach ($UserAdmin as $k) {
        //     $AdminId    = $k->id;
        if(companySetting("is_notification") == 1){            
            LibNotification::CreateNotif(intval($IdAnggota->id), 0, 0, 0, 'Anggota', $Ket, 'Admin', 0);
        }
        // }        

        
        $base_url    = env('APP_URL');
        echo '<script>alert("Terimakasih. Formulir pendaftaran telah di kirim")</script>';
        echo '<script>window.close();</script>';
        // echo '<script>window.location.href = "'.$base_url.'"; </script>';
    }

    public function sendemail($id)
    {
        $MsAnggota = MsAnggota::findorfail($id);
        $Email  = $MsAnggota->email;
        $url    = env("APP_URL").'/admin/master_anggota';
        $data = [
            'url' => $url,
            'nik' => $MsAnggota->nik,
            'nama' => $MsAnggota->nama_anggota,
            'perusahaan' => $MsAnggota->Perusahaan->nama." - ".$MsAnggota->Department->nama,
            'status_karyawan' => $MsAnggota->status_karyawan,
            'jenis_kelamin' => $MsAnggota->jenis_kelamin,
            'tempat_lahir' => $MsAnggota->tempat_lahir,
            'tgl_lahir' => $MsAnggota->tgl_lahir,
            'email' => $MsAnggota->email,
            'no_telpon'=> $MsAnggota->no_telpon,
            'alamat' => $MsAnggota->alamat,
            'alamat_domisili' => $MsAnggota->alamat_domisili,
            'body' => 'Tes Registrasi Anggota'
            ];

        $EmailKetua = LibMaster::getPengurus('Ketua');
        $EmailSekr = LibMaster::getPengurus('Sekretaris');
        $EmailBend = LibMaster::getPengurus('Bendahara');
        
        if(companySetting("notif_email") == 1){
            Mail::to($Email)->cc([$EmailKetua,$EmailSekr, $EmailBend])->send(new RegistrasiAnggotaMail($data));
        }
            // dd("Email sudah terkirim.");
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
