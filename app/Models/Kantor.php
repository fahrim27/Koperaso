<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{

    protected $table = 'kantor';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode',
        'kantor',
    ];


}
