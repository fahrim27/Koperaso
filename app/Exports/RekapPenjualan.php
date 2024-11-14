<?php

namespace App\Exports;

use App\JbOrder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapPenjualan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    **/
    protected $TglMulai;
    protected $TglSelesai;
    function __construct($TglMulai, $TglSelesai)
    {
        $this->TglMulai = $TglMulai;
        $this->TglSelesai = $TglSelesai;
    }

    public function collection() 
    {
        $TglMulai = $this->TglMulai;
        $TglSelesai= $this->TglSelesai;

        $Data   = JbOrder::join('ms_anggota','ms_anggota.id', '=', 'jb_order.id_anggota')->where('jb_order.status_order', 'Selesai')->where('jb_order.tanggal','>=', $TglMulai)->where('jb_order.tanggal','<=', $TglSelesai)->orderBy('jb_order.no_trx', 'ASC')->get([
            'jb_order.no_trx','jb_order.tanggal', 'ms_anggota.nama_anggota', 'jb_order.pembayaran', 'jb_order.total'
        ]);
        return $Data;
    }
  
    public function headings(): array
    {
        return [
          'No Transaksi', 'Tanggal', 'Nama Anggota', 'Pembayaran', 'Total'
        ];
    }
}
