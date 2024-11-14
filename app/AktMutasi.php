<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktMutasi extends Model
{

    protected $table ='akt_mutasi';
    protected $fillable = [
      'tanggal', 'kde_akun', 'no_bukti', 'keterangan', 'debet', 'kredit', 'jns_mutasi', 'user_id'
    ];
}
