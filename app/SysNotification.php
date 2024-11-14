<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysNotification extends Model
{
    protected $table ='sys_notification';
    protected $fillable = [
        'id_anggota', 'id_reksimp', 'id_rekpby','id_pengajuan', 'tanggal', 'jenis', 'keterangan', 'role', 'is_read', 'user_id'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }

    public function SimpRekening()
    {
        return $this->belongsTo('App\SimpRekening', 'id_reksimp');
    }

    public function PbyRekening()
    {
        return $this->belongsTo('App\PbyRekening', 'id_rekpby');
    }

    public function PbyPengajuan()
    {
        return $this->belongsTo('App\PbyPengajuan', 'id_pengajuan');
    }

}
