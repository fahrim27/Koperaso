@extends('layouts_print.app_print')
@section('content-app')
<div class="card-body">
    <div class="card-option">
    <h3 align="center"> Laporan Buku Besar</h3>
        <p align="center">Periode : {{ \Carbon\Carbon::parse($TglMulai)->translatedFormat('d F Y') }} s.d {{ \Carbon\Carbon::parse($TglSelesai)->translatedFormat('d F Y') }}</p>
        <p align="left">
            <table border="0">
                <tr>
                    <th>Nama Akun</th>
                    <th width="10px">:</th>
                    <th>{{ $KodeAkun }} - {{ $NamaAkun }}</th>
                </tr>
            </table>
        </p>
    </div>
    <table id="#" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No Transaksi</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Keterangan</th>                            
            </tr>
        </thead>
        <tbody>
            @foreach ($BukBes as $Akt)
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
        </tbody>
        <tfoot>
            <tr style="text-align: center; font-weight: bold;">
                <td colspan='2' >TOTAL</td>
                <td  align="right">{{number_format($TotDebet,2)}}</td>
                <td  align="right">{{number_format($TotKredit,2)}}</td>
                <td  align="right">{{number_format($SaldoAkhir,2)}}</td>
            </tr>
        </tfoot>
        
    </table>

@endsection
