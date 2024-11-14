<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PbySimulasi extends Model
{
    protected $table ='pby_simulasi';
    protected $fillable = [
        'angske', 'angs_pokok', 'angs_jasa', 'user_id'
    ];
}
