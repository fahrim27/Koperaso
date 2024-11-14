<?php

namespace App\Exports;

use App\PbyMutasi;
use App\PbyRekening;
use Maatwebsite\Excel\Concerns\FromCollection;

class PinjamanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $DataPby = PbyRekening::join('ms_anggota','ms_anggota.id', '=', 'pby_rekening.id_anggota')->join('pby_master', 'pby_master.id', '=', 'pby_rekening.id_pinjaman')->get(['pby_rekening.id', 'pby_rekening.no_rek', 'ms_anggota.nama_anggota', 'pby_master.nama']);

        return $DataPby;
    }
}
