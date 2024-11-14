@extends('layouts_print.app_print')
@section('content-app')
<div class="card-body">
    <div class="card-option">
    <h3 align="center"> Laporan Jurnal</h3>
        <p align="center">Periode : {{ \Carbon\Carbon::parse($TglMulai)->translatedFormat('d F Y') }} s.d {{ \Carbon\Carbon::parse($TglSelesai)->translatedFormat('d F Y') }}</p>
    </div>
    <table id="#" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="5px">Tanggal</th>
                <th>No Transaksi</th>
                <th>Nama Akun</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Keterangan</th>                            
            </tr>
        </thead>
        <tbody>
            @foreach ($KasMutasi as $Akt)
            <tr>
                <td>
                    {{ \Carbon\Carbon::parse($Akt->tanggal)->format('d-m-Y') }}
                </td>
                <td>
                    {{ $Akt->no_bukti }}
                </td>
                
                <td>
                    @if ($Akt->pos_akun == 1)
                        {{ $Akt->nma_akun }}
                    @else
                        &nbsp;&nbsp;{{ $Akt->nma_akun }}
                    @endif
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
    </table>

@endsection
