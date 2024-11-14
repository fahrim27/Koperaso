<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsDepartment extends Model
{
    protected $table ='ms_department';
    protected $fillable = [
        'nama'
    ];
}
