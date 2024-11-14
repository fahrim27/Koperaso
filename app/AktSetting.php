<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktSetting extends Model
{
    protected $table ='akt_setting';
    protected $fillable = [
      'akun_kas', 'akun_persediaan', 'shu_thnberjalan', 'shu_thnlalu'
    ];
}
