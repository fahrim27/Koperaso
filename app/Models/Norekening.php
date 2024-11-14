<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Norekening extends Model
{
    protected $table = 'no_rekening';

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'anggota_id');
    }



}
