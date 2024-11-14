<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetailPinjaman implements FromCollection, WithHeadings
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
            $Data    = DB::select("SELECT r.no_rek, a.nama_anggota, m.nama, r.plafond, r.tgl_cair, r.jangka, r.jth_tempo, r.angske, r.saldo_akhir FROM pby_rekening r, pby_master m, ms_anggota a WHERE r.id_anggota=a.id AND r.id_pinjaman=m.id AND r.status='Aktif' ORDER BY r.no_rek");
        }else{
            $Data    = DB::select("SELECT r.no_rek, a.nama_anggota, m.nama, r.plafond, r.tgl_cair, r.jangka, r.jth_tempo, r.angske, r.saldo_akhir FROM pby_rekening r, pby_master m, ms_anggota a WHERE r.id_anggota=a.id AND r.id_pinjaman=m.id AND r.status='Aktif' AND r.id_pinjaman=? ORDER BY r.no_rek",[$IdPby]);
        }
        return collect($Data);
    }
  
    public function headings(): array
    {
        return [
          'No. Rek', 'Nama Anggota', 'Nama Pinjaman', 'Plafond', 'Tgl Cair', 'Tenor' , 'Jth Tempo', 'Angs ke-', 'Saldo Pinjaman'
        ];
    }
}
