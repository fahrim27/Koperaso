<?php

namespace App\Exports;

use App\SimpRekening;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class SimpananExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $DataSimp   = DB::select("select r.id, r.no_rek, a.nama_anggota, m.nama from simp_rekening r, ms_anggota a, simp_master m where r.id_anggota=a.id and r.id_simpanan=m.id and r.status_aktif=?", ['Y']);
        $DataSimp = SimpRekening::join('ms_anggota','ms_anggota.id', '=', 'simp_rekening.id_anggota')->join('simp_master', 'simp_master.id', '=', 'simp_rekening.id_simpanan')->get(['simp_rekening.id', 'simp_rekening.no_rek', 'ms_anggota.nama_anggota', 'simp_master.nama']);
        
        return $DataSimp;
    }

    public function headings(): array
    {
        return [
          'ID', 'No Rek','Nama Anggota','Simpanan Pokok', 'Jenis(Setor/Tarik)', 'Nominal'
        ];
    }
}
