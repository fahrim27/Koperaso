<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapPinjaman implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    **/
    protected $IdPby;
    function __construct($IdPby)
    {
        $this->IdPby = $IdPby;
    }

    public function collection() 
    {
        $IdPby = $this->IdPby;

        if ($IdPby == null) {
            $Data = 
            DB::select("SELECT r.id_pinjaman, m.nama, SUM(r.saldo_akhir) AS saldo FROM pby_master m, pby_rekening r WHERE r.id_pinjaman= m.id GROUP BY r.id_pinjaman, m.nama");   
        }else{
            $Data = 
            DB::select("SELECT r.id_pinjaman, m.nama, SUM(r.saldo_akhir) AS saldo FROM pby_master m, pby_rekening r WHERE r.id_pinjaman= m.id AND r.id_pinjaman=? GROUP BY r.id_pinjaman, m.nama",[$IdPby]); 
        }
        return collect($Data);
    }
  
    public function headings(): array
    {
        return [
          'Nama Pinjaman', 'Total Saldo'
        ];
    }
}
