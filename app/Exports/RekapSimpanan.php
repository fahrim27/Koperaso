<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapSimpanan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    **/
    protected $IdSimp;
    function __construct($IdSimp)
    {
        $this->IdSimp = $IdSimp;
    }

    public function collection() 
    {
        $IdSimp = $this->IdSimp;

        if ($IdSimp == null) {
            $Data = 
            DB::select("SELECT m.nama, SUM(r.saldo_akhir) AS saldo FROM simp_master m, simp_rekening r WHERE r.id_simpanan= m.id GROUP BY r.id_simpanan, m.nama");   
        }else{
            $Data = 
            DB::select("SELECT m.nama, SUM(r.saldo_akhir) AS saldo FROM simp_master m, simp_rekening r WHERE r.id_simpanan= m.id AND r.id_simpanan=? ORDER BY r.id_simpanan GROUP BY r.id_simpanan, m.nama",[$IdSimp]);
        }
        return collect($Data);
    }
  
    public function headings(): array
    {
        return [
          'Nama Simpanan', 'Total Saldo'
        ];
    }
}
