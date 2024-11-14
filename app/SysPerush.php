<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysPerush extends Model
{
    protected $table ='sys_perush';
    protected $fillable = [
        'kde_kantor', 'nma_perush', 'nma_cabang', 'kta_perush', 'alm_perush', 'eml_perush', 'website', 'notifikasi', 'email', 'stok_inventory'
    ];
}
