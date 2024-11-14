@extends('layouts_print.app_print')
@section('content-app')
<div class="card-body">
    <div class="card-option">
        <h3 align="center"> Laporan Neraca</h3>
        @php
          $Tgl = $Thn."-".$Bln."-01";
        @endphp
        <p align="center">Periode : {{ \Carbon\Carbon::parse($Tgl)->translatedFormat('F') }} {{ $Thn }}</p>
    </div>
    <table id="#" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th>Kode Akun</th>
              <th>Nama Akun</th>
              <th>Debet</th>
              <th>Kredit</th>
              <th>Saldo Akhir</th>                            
          </tr>
        </thead>
        <tbody>
          @foreach ($Neraca as $Akt)
            <tr>
              <td>
                  {{ $Akt->kde_akun }}
              </td>
              <td>
                @if ($Akt->pos_akun=="1")
                  {{ $Akt->nma_akun }}
                @else
                  &nbsp;&nbsp;&nbsp;&nbsp;{{ $Akt->nma_akun }}
                @endif                            
              </td>
              <td align="right">
                  {{ number_format($Akt->debet,2) }}
              </td>
              <td align="right">
                  {{ number_format($Akt->kredit,2) }}
              </td>
              <td align="right">
                {{ number_format($Akt->saldo_akhir,2) }}
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
@endsection
