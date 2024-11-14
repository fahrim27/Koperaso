<?php

namespace App\Exports;

USE Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetailSimpanan implements FromCollection, WithHeadings
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
            $Data    = 
            DB::select("SELECT r.no_rek, a.nama_anggota, m.nama, r.setoran, r.saldo_akhir FROM simp_rekening r, ms_anggota a, simp_master m WHERE r.id_simpanan=m.id AND r.id_anggota=a.id 
            AND status_aktif='Y' AND saldo_akhir>?", [0]);
            
        }else{
            $Data    = 
            DB::select("SELECT r.no_rek, a.nama_anggota, m.nama, r.setoran, r.saldo_akhir FROM simp_rekening r, ms_anggota a, simp_master m WHERE r.id_simpanan=m.id AND r.id_anggota=a.id 
            AND status_aktif='Y' AND saldo_akhir>? AND r.id_simpanan=?", [0, $IdSimp]);  
        }
        return collect($Data);
    }
  
    public function headings(): array
    {
        return [
          'No Rekening', 'Nama Anggota', 'Nama Simpanan', 'Setoran', 'Saldo Simpanan'
        ];
    }
}
