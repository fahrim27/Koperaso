<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArsipShu extends Model
{
    protected $table ='akt_arsipshu';
    protected $fillable = [
        'tanggal', 'shu'
    ];
}
