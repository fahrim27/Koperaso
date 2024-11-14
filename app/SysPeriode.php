<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysPeriode extends Model
{
    protected $table ='sys_periode';
    protected $fillable = [
        'tgl_mulaitag', 'tgl_selesaitag'
    ];
}
