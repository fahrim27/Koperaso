@extends('layouts_anggota.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SHU Anggota</h3>
                  <div class="card-options">
                    <blockquote class="blockquote">
                        <h4>{{ $NamaAgt }}</h4>
                        <h5>{{ $Perush }}</h5>
                    </blockquote>
                </div>
            </div>
            <div class="card-body">
                <h3>Total SHU : Rp. {{ number_format($TotShuTahun,2) }}</h3>
                <table id="table-data" class="table table-striped table-bordered" width="50%" >
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th width="20px">Prosentase (%)</th>
                            <th>Jumlah SHU Dibagikan</th>
                        </tr>
                    </thead>                    
                    <tbody>
                    @foreach ($ItemShu as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->persen }} %</td>
                            <td align="right">Rp. {{ number_format(($TotShuTahun*($p->persen/100)),2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" align="center"><b>T O T A L</b></td>
                        <td align="right"><b>Rp. {{ number_format($TotShuTahun,2) }}</b></td>
                    </tr>
                </tbody>
                    
                </table>
                <br>
                <br>
                <h3>Porsi Pembagian SHU</h3>
                <table id="tabel-data" class="table table-striped table-bordered" width="100%" >
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Partisipasi Anda</th>
                            <th>Total Partisipasi Anggota</th>
                            <th width="20px">Estimasi Porsi SHU (%)</th>
                            <th>Estimasi SHU Yg Diterima</th>
                        </tr>
                    </thead>                    
                    <tbody>
                        <tr>
                            <td>SHU Jasa Modal</td>
                            <td align="right">Rp. {{ number_format($SaldoSimp,2) }}</td>
                            <td align="right">Rp. {{ number_format($JmlSimp,2) }}</td>
                            <td>{{ $PorsiShuModal }} %</td>
                            <td align="right">Rp. {{ number_format(($TotShuTahun*(20/100))*($PorsiShuModal/100),2) }}</td>
                        </tr>
                        <tr>
                            <td>SHU Jasa Usaha</td>
                            <td align="right">Rp. {{ number_format($TotJasa,2) }}</td>
                            <td align="right">Rp. {{ number_format($TotJasaAll,2) }}</td>
                            <td>{{ $PorsiShuJasa }} %</td>
                            <td align="right">Rp. {{ number_format(($TotShuTahun*(25/100))*($PorsiShuJasa/100),2) }}</td>
                        </tr>
                    </tbody>
                </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
