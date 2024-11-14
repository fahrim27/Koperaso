<?php

namespace App\Imports;

use App\SimpImport;
use App\SimpMutasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class SimpMutasiImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SimpImport([
            'id_norek' =>$row[0],
            'no_rek' =>$row[1],
            'nama_anggota' =>$row[2],
            'nama_simpanan' => $row[3],
            'jenis' =>$row[4],
            'nominal' => $row[5]
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
