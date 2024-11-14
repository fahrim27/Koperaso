<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartAccount extends Model
{

    protected $table ='chart_account';
    protected $fillable = [
      'jenis', 'kde_akun', 'nma_akun', 'pos_akun', 'saldo_awal', 'debet', 'kredit', 'saldo_akhir'
    ];
}
