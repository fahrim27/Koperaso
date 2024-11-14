@extends('layouts_print.app_print')
@section('content-app')
<div class="card-body">
    <div class="card-option">
    <h3 align="center"> Laporan Arus Kas</h3>
        <p align="center">Periode : {{ \Carbon\Carbon::parse($TglMulai)->translatedFormat('d F Y') }} s.d {{ \Carbon\Carbon::parse($TglSelesai)->translatedFormat('d F Y') }}</p>
    </div>
    <table class="table table-striped table-bordered" width="50%" >
        <tr>
            <th>Keterangan</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
            <th>Saldo Akhir</th>
        </tr>
        <tr>
            <td colspan="3"><b>Saldo Awal Kas</b></td>
            <td>Rp. {{ number_format($SaldoAwal,2) }}</td>
        </tr>
        <tr>
            <td><b>Mutasi Kas</b></td>
            <td><b>Rp. {{ number_format($Masuk,2) }}</b></td>
            <td><b>Rp. {{ number_format($Keluar,2) }}</b></td>
            <td><b>Rp. {{ number_format($SaldoAkhir,2) }}</b></td>
        </tr>
    </table>
    
    <br><br>
    <table id="#" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No Transaksi</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Keterangan</th>                            
            </tr>
        </thead>
        <tbody>
        @foreach ($ArusKas as $Akt)
        <tr>
            <td>
                {{ $Akt->tanggal }}
            </td>
            <td>
                {{ $Akt->no_bukti }}
            </td>
            <td align="right">
                {{ number_format($Akt->debet,2) }}
            </td>
            <td align="right">
                {{ number_format($Akt->kredit,2) }}
            </td>
            <td>
                {{ $Akt->keterangan }}
            </td>
        </tr>
        @endforeach
        <tr style="font-weight: bold">
            <td colspan="2" align="center">T O T A L</td>
            <td align="right">{{ number_format($Masuk,2) }}</td>
            <td align="right">{{ number_format($Keluar,2) }}</td>
            <td></td>
        </tr>
        </tbody>
    </table>  

@endsection
