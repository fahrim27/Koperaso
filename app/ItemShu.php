<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemShu extends Model
{
    protected $table ='sys_setshu';
    protected $fillable = [
        'nama', 'persen', 'akun'
    ];
}
