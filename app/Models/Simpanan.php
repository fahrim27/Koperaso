<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{

    protected $table = 'jen_simpanan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode',
        'jenis',
        'jumlah',
        'tenor',
        'bunga',
        'nama',
    ];


}
