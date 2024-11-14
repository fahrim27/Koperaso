<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsAnggota extends Model
{
    protected $table ='ms_anggota';
    protected $fillable = [
        'user_id', 'no_anggota', 'nik', 'nama_anggota', 'email', 'id_perusahaan', 'no_ktp',
        'id_department', 'tempat_lahir', 'tgl_lahir', 'no_telpon', 'jenis_kelamin', 'status_karyawan', 'no_rekening', 'id_jabatan', 'foto_ktp', 'alamat', 'status_keanggotaan', 'alamat_domisili', 'kontak_darurat'
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function Jabatan()
    {
        return $this->belongsTo('App\MsJabatan', 'id_jabatan');
    }

    public function Perusahaan()
    {
        return $this->belongsTo('App\MsPerusahaan', 'id_perusahaan');
    }

    public function Department()
    {
        return $this->belongsTo('App\MsDepartment', 'id_department');
    }

    public function RekeningSimp()
    {
        return $this->hasMany('App\SimpRekening', 'id_anggota');
    }

    public function Pengajuan()
    {
        return $this->hasMany('App\PbyPengajuan', 'id_anggota');
    }

    public function JbOrder()
    {
        return $this->hasMany('App\JbOrder', 'id_anggota');
    }

    public function ShuJasaAgt()
    {
        return $this->hasMany('App\ShuJasaAgt', 'id_anggota');
    }

    public function AgtTransaksi()
    {
        return $this->hasMany('App\AgtTransaksi', 'id_anggota');
    }

    public function AgtCart()
    {
        return $this->hasMany('App\AgtCart', 'id_anggota');
    }

    public function Notification()
    {
        return $this->hasMany('App\SysNotification', 'id_anggota');
    }

    public function Autotagih()
    {
        return $this->hasMany('App\AutoTagih', 'id_anggota');
    }

    public function AutoTagihDetail()
    {
        return $this->hasMany('App\AutoTagihDetail', 'id_anggota');
    }
}
