<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PbyPengajuan extends Model
{
    protected $table ='pby_pengajuan';
    protected $fillable = [
        'id_anggota', 'id_pinjaman', 'id_order', 'no_pengajuan', 'no_rek', 'jenis', 'tanggal', 'nominal', 'jangka', 'keperluan', 'jaminan', 'user_id','status_pengajuan', 'tgl_ubah', 'keterangan', 'approve_by_hr', 'approve_by_cfo', 'foto_ttd'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }

    public function PbyMaster()
    {
        return $this->belongsTo('App\PbyMaster', 'id_pinjaman');
    }

    public function PbyRekening()
    {
        return $this->belongsTo('App\PbyRekening', 'id_pengajuan');
    }
    
    public function JbOrder()
    {
        return $this->belongsTo('App\JbOrder', 'id_order');
    }

    public function Notification()
    {
        return $this->hasMany('App\SysNotification', 'id_pengajuan');
    }
    
}
