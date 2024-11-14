<?php

namespace App\Exports;

use App\JbOrder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanPerBarang implements FromCollection, WithHeadings
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

        $Data = DB::select("SELECT m.nama_barang, d.qty, d.hpp, d.harga, ((d.harga-d.hpp)*d.qty) AS margin FROM jb_order t, jb_order_detail d, ms_produk m WHERE d.id_order=t.id AND d.id_produk=m.id AND t.status_order='Selesai' AND t.tanggal>=? AND t.tanggal<=? GROUP BY m.id, m.nama_barang, d.qty, d.hpp, d.harga ",[$TglMulai, $TglSelesai]);

        return collect($Data);
    }
  
    public function headings(): array
    {
        return [
          'Nama Barang', 'Qty', 'Harga Beli', 'Harga Jual', 'Margin'
        ];
    }
}
