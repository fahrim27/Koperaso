<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{

    protected $table = 'departemen';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
    ];


}
