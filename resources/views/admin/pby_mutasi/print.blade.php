@extends('layouts_print.app_print')
@section('content-app')
<br>
<h3 align="center"> Bukti Angsuran  Pinjaman</h3>
<table border="0">
    <tr>
        <td>No. Transaksi</td>
        <td align="center" width="20px">:</td>
        <td>{{ $PbyMutasi->no_bukti }}</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td align="center">:</td>
        <td>{{ \Carbon\Carbon::parse($PbyMutasi->tanggal)->translatedFormat('d F Y') }}</td>
    </tr>
</table>
<hr>
<div class="card">
    <div class="card-body">
        <table border="0">
            <tr>
                <td>No. - Nama Anggota</td>
                <td align="center" width="20px">:</td>
                <td>{{ $PbyMutasi->PbyRekening->Anggota->no_anggota }} - {{ $PbyMutasi->PbyRekening->Anggota->nama_anggota }}</td>
            </tr>
            <tr>
                <td>No. Rekening</td>
                <td align="center">:</td>
                <td>{{  $PbyMutasi->PbyRekening->no_rek }} - {{ $PbyMutasi->PbyRekening->PbyMaster->nama }}</td>
            </tr>
            <tr>
                <td>Angsuran Pokok </td>
                <td align="center">:</td>
                <td>Rp. {{ number_format($PbyMutasi->angs_pokok,2)}}</td>
            </tr>
            <tr>
                <td>Angsuran Jasa </td>
                <td align="center">:</td>
                <td>Rp. {{ number_format($PbyMutasi->angs_jasa,2)}}</td>
            </tr>
            <tr style="font-weight: bold;">
                <td align="center">TOTAL</td>
                <td align="center">:</td>
                <td>Rp. {{ number_format($PbyMutasi->angs_pokok+$PbyMutasi->angs_jasa,2)}}</td>
            </tr>
        </table>
    </div>
</div>
<hr>
<table border=0 width="100%">
    <tr>
        <td>Menyetujui/Mengetahui</td>
        <td align="center" width="30%">&nbsp;</td>
    </tr>
    <tr>
        <td>Pengurus Koperasi</td>
        <td align="center">Anggota</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>________________________</td>
        <td align="center">________________________</td>
    </tr>
    <tr>
        <td></td>
        <td align="center"></td>
    </tr>
</table>
@endsection
