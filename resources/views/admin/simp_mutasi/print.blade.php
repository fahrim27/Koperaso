@extends('layouts_print.app_print')
@section('content-app')
<br>
<h3 align="center"> Bukti Transaksi {{ $SimpMutasi->debet>0 ? 'Penarikan Simpanan' : 'Setoran Simpanan' }}</h3>
<table border="0">
    <tr>
        <td>No. Transaksi</td>
        <td align="center" width="20px">:</td>
        <td>{{ $SimpMutasi->no_bukti }}</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td align="center">:</td>
        <td>{{ \Carbon\Carbon::parse($SimpMutasi->tanggal)->translatedFormat('d F Y') }}</td>
    </tr>
</table>
<hr>
<div class="card">
    <div class="card-body">
        <table border="0">
            <tr>
                <td>No. - Nama Anggota</td>
                <td align="center" width="20px">:</td>
                <td>{{ $SimpMutasi->SimpRekening->Anggota->no_anggota }} - {{ $SimpMutasi->SimpRekening->Anggota->nama_anggota }}</td>
            </tr>
            <tr>
                <td>No. Rekening</td>
                <td align="center">:</td>
                <td>{{  $SimpMutasi->SimpRekening->no_rek }} - {{ $SimpMutasi->SimpRekening->SimpMaster->nama }}</td>
            </tr>
            <tr>
                <td>Jumlah </td>
                <td align="center">:</td>
                <td>Rp. {{  $SimpMutasi->debet>0 ? number_format($SimpMutasi->debet) : number_format($SimpMutasi->kredit) }}</td>
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
