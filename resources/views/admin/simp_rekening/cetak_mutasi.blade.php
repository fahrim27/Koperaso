@extends('layouts_print.app_print')
@section('content-app')
<div class="card-body">
    <div class="card-option">
    <h3 align="center"> Mutasi Rekening Simpanan</h3>
        <blockquote class="blockquote">
            <h4>{{ $SimpRek->Anggota->nama_anggota }}</h4>
            <h5>{{ $SimpRek->no_rek }} - {{ $SimpRek->SimpMaster->nama }}</h5>
            <h5><b>Saldo Akhir : Rp. {{ number_format($SimpRek->saldo_akhir,2) }}</b></h5>
        </blockquote>
    </div>
    <table id="#" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No. Transaksi</th>
                <th>Keterangan</th>
                <th>Debet</th>
                <th>Kredit</th>
                {{--  <th></th>  --}}
            </tr>                  
        </thead>
        <tbody>
            @if ($SimpMutasi <> [])
                @foreach ($SimpMutasi as $s)
                    <tr>
                        <td>{{ $s->tanggal }}</td>
                        <td>{{ $s->no_bukti }}</td>
                        <td>{{ $s->keterangan }}</td>
                        <td align="right">{{ number_format($s->debet,2) }}</td>
                        <td align="right">{{ number_format($s->kredit,2) }}</td>
                        {{--  <td></td>  --}}
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" align="center"> <b>T O T A L</b></td>                            
                    <td align="right"><b>{{ number_format($JmlDebet,2) }}</b></td>
                    <td align="right"><b>{{ number_format($JmlKredit,2) }}</b></td>
                </tr>
            @else
                <tr>
                    <td colspan="6"><p align="center">Tidak ada mutasi</p></td>
                </tr>
            @endif
        </tbody>
    </table>

@endsection
