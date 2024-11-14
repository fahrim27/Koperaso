@extends('layouts_print.app_print')
@section('content-app')
<div class="card-body">
    <div class="card-option">
        <h3 align="center"> Laporan Laba Rugi</h3>
        <p align="center">Periode : {{ \Carbon\Carbon::parse($TglMulai)->translatedFormat('d F Y') }} s.d {{ \Carbon\Carbon::parse($TglSelesai)->translatedFormat('d F Y') }}</p>
    </div>
    <table id="#" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode Akun</th>
                <th>Nama Akun</th>
                <th>Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Pendptan as $k)
                <tr>
                    <td>
                        {{ $k->kde_akun }}
                    </td>
                    <td>
                        @if ($k->pos_akun == 1)
                            {{ $k->nma_akun }}
                        @else
                            &nbsp;&nbsp;{{ $k->nma_akun }}
                        @endif
                    </td>
                    <td align="right">{{ number_format($k->saldo_akhir,2) }}</td>
                </tr>                                
            @endforeach
            <tr>
                <td colspan="2" align="center" class="font-weight-bold">
                    TOTAL PENDAPATAN
                </td>
                <td align="right" class="font-weight-bold">
                    {{ number_format($JmlPendpt,2) }}
                </td>
            </tr>
            @foreach ($Biaya as $b)
            <tr>
                <td>
                    {{ $b->kde_akun }}
                </td>
                <td>
                    @if ($b->pos_akun == 1)
                        {{ $b->nma_akun }}
                    @else
                        &nbsp;&nbsp;{{ $b->nma_akun }}
                    @endif
                </td>
                <td align="right">{{ number_format($b->saldo_akhir,2) }}</td>
            </tr>  
            @endforeach
            <tr>
                <td colspan="2" align="center" class="font-weight-bold">
                    TOTAL BIAYA
                </td>
                <td align="right" class="font-weight-bold">
                    {{ number_format($JmlBiaya,2) }}
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" class="font-weight-bold">
                    SISA HASIL USAHA
                </td>
                <td align="right" class="font-weight-bold">
                    {{ number_format($JmlPendpt-$JmlBiaya,2) }}
                </td>
            </tr>
        </tbody>
    </table>
@endsection
