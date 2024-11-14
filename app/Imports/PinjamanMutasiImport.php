<?php

namespace App\Imports;

use App\PbyImport;
use Maatwebsite\Excel\Concerns\ToModel;

class PinjamanMutasiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PbyImport([
            'id_norek' =>$row[0],
            'no_rek' =>$row[1],
            'nama_anggota' =>$row[2],
            'nama_pinjaman' => $row[3],
            'angs_pokok' => $row[4],
            'angs_jasa' => $row[5]
        ]);
    }
}
