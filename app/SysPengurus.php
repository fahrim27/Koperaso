<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysPengurus extends Model
{
    protected $table ='sys_pengurus';
    protected $fillable = [
        'posisi', 'nama', 'email'
    ];
}
