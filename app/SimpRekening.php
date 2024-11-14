<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpRekening extends Model
{
    protected $table ='simp_rekening';
    protected $fillable = [
        'id_anggota', 'id_simpanan', 'no_rek', 'tgl_buka', 'tgl_tutup', 'jasa_persen', 'saldo_awal_sys', 'saldo_akhir','setoran','is_setor', 'user_id', 'status_aktif', 'status_blokir', 'jmlskip_tagih'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }

    public function SimpMaster()
    {
        return $this->belongsTo('App\SimpMaster', 'id_simpanan');
    }

    public function SimpMutasi()
    {
        return $this->hasMany('App\SimpMutasi', 'id_norek');
    }

    public function AgtTransaksi()
    {
        return $this->hasMany('App\AgtTransaksi', 'id_norek');
    }

    public function Notification()
    {
        return $this->hasMany('App\SysNotification', 'id_reksimp');
    }

    public function AutoTagihDetail()
    {
        return $this->hasMany('App\AutoTagihDetail', 'id_reksimpanan');
    }

}
