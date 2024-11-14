<?php

namespace App\Exports;

use App\AutoTagihNew;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagihanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    **/
    // public $DataTgh;
    // public function __construct($DataTgh)
    // {
    //     $this->DataTgh = $DataTgh;
    // }


    public function collection() 
    {
        $Periode= periodeTagihan('periode');

        $DataTgh = AutoTagihNew::join('ms_anggota','ms_anggota.id', '=', 'tgh_anggota_new.id_anggota')->where('tgh_anggota_new.periode', $Periode)->orderBy('ms_anggota.no_anggota', 'ASC')->get(['tgh_anggota_new.periode', 'ms_anggota.no_anggota', 'ms_anggota.nama_anggota', 'tgh_anggota_new.simp_pokok', 'tgh_anggota_new.simp_wajib', 'tgh_anggota_new.simp_sukarela', 'tgh_anggota_new.cicilan_barang', 'tgh_anggota_new.tenor_cicil', 'tgh_anggota_new.angske_cicil', 'tgh_anggota_new.pinjaman_tunai', 'tgh_anggota_new.tenor_tunai','tgh_anggota_new.angske_tunai','tgh_anggota_new.total_tagihan']);
        return $DataTgh;
    }
  
    public function headings(): array
    {
        return [
          'Periode','No Anggota', 'Nama Anggota','Simpanan Pokok','Simpanan Wajib', 'Simpanan Sukarela','Cicilan Barang', 'Tenor', 'AngsKe', 'Pinjaman Tunai', 'Tenor', 'AngsKe', 'Total Tagihan'
        ];
    }
    // public function collection()
    // {
    //     $DataTgh = AutoTagih::join('ms_anggota','ms_anggota.id', '=', 'tgh_anggota.id_anggota')->get(['tgh_anggota.periode', 'ms_anggota.nama_anggota', 'tgh_anggota.simp_pokok', 'tgh_anggota.simp_wajib', 'tgh_anggota.simp_sukarela', 'tgh_anggota.cicilan_barang', 'tgh_anggota.pinjaman_tunai', 'tgh_anggota.total_tagihan']);

    //     return $DataTgh;
    // }
}
