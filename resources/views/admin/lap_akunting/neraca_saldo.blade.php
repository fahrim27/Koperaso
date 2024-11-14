@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Neraca Saldo</h3>
                <div class="card-options">
                    <form action="{{url('admin/lap_akunting/neracasaldo')}}" method="POST">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Filter Periode</label>
                                <select class="js-example-basic-single w-100" name="bulan" id="single" autofocus>
                                <option value="">-- Pilih Bulan --</option>
                                  <option value="01" {{ $Bln=="01" ? "selected" : "" }} >Januari</option>
                                  <option value="02" {{ $Bln=="02" ? "selected" : "" }} >Februari</option>
                                  <option value="03" {{ $Bln=="03" ? "selected" : "" }} >Maret</option>
                                  <option value="04" {{ $Bln=="04" ? "selected" : "" }} >April</option>
                                  <option value="05" {{ $Bln=="05" ? "selected" : "" }} >Mei</option>
                                  <option value="06" {{ $Bln=="06" ? "selected" : "" }} >Juni</option>
                                  <option value="07" {{ $Bln=="07" ? "selected" : "" }} >Juli</option>
                                  <option value="08" {{ $Bln=="08" ? "selected" : "" }} >Agustus</option>
                                  <option value="09" {{ $Bln=="09" ? "selected" : "" }} >September</option>
                                  <option value="10" {{ $Bln=="10" ? "selected" : "" }} >Oktober</option>
                                  <option value="11" {{ $Bln=="11" ? "selected" : "" }} >November</option>
                                  <option value="12" {{ $Bln=="12" ? "selected" : "" }} >Desember</option>
                                </select>
                            </div>                          
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                <label>&nbsp;</label>
                                <input type="number" name="tahun" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y') }}">
                              </div>                          
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/neracasaldo')}}"><i class="fa fa-table"></i> Tampilkan</button>
                              <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/neracasaldo/cetak')}}" formtarget="_blank"><i class="fa fa-print"></i> Cetak Neraca</button>
                            </div>
                          </div>
                        </div>
                      </form> 
                </div>
            </div>
            <div class="card-body">
                @if ($Neraca <> [])
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
                    {{--  <tr style="font-weight: bold">
                        <td colspan="2" align="center">T O T A L</td>
                        <td align="right">{{ number_format($Masuk,2) }}</td>
                        <td align="right">{{ number_format($Keluar,2) }}</td>
                        <td></td>
                    </tr>  --}}
                  </tbody>
              </table>                  
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
