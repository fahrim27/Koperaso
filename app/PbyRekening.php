<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PbyRekening extends Model
{
    protected $table ='pby_rekening';
    protected $fillable = [
        'id_anggota', 'id_pinjaman', 'id_pengajuan', 'no_rek', 'tgl_cair', 'jangka', 'jth_tempo', 'plafond', 'bya_adm', 'angske', 'saldo_awal_pokok_sys', 'saldo_awal_jasa_sys', 'saldo_akhir', 'user_id', 'status'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }

    public function PbyMaster()
    {
        return $this->belongsTo('App\PbyMaster', 'id_pinjaman');
    }

    public function Pengajuan()
    {
        return $this->belongsTo('App\PbyPengajuan', 'id_pengajuan');
    }
    
    public function PbyJadwal()
    {
        return $this->hasMany('App\PbyJadwal', 'id_norek');
    }

    public function PbyMutasi()
    {
        return $this->hasMany('App\PbyMutasi', 'id_norek');
    }

    public function Notification()
    {
        return $this->hasMany('App\SysNotification', 'id_rekpby');
    }

    public function AutoTagihDetail()
    {
        return $this->hasMany('App\AutoTagihDetail', 'id_rekpinjaman');
    }
}
