<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{

    protected $table = 'jen_pinjaman';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode',
        'jenis',
    ];


}
