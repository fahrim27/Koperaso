@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Penjualan Barang</h3>
                <div class="card-options">
                    <form action="{{url('admin/lap_penjualan/preview')}}" method="POST">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Filter Periode</label>
                              <input type="date" name="tgl_mulai" class="form-control" value="{{ $TglMulai }}" >
                            </div>                          
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label>&nbsp;</label>
                                <input type="date" name="tgl_selesai" class="form-control" value="{{ $TglSelesai }}">
                              </div>                          
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="">Tampilkan Laporan</label>
                          <div class="row col-md-8">
                            <div class="col-sm-4">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jns_lap" id="rekap" value="1"  data-description="Rekap Penjualan" {{ $JnsLap=="1" ? "checked" : "" }}>
                                    Rekap Penjualan
                                  </label>
                                </div>
                              </div>
                              <div class="col-sm-5">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jns_lap" id="perbarang" value="2" data-description="Penjualan per Barang" {{ $JnsLap=="2" ? "checked" : "" }}>
                                    Penjualan per Barang
                                  </label>
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <button type="submit" name="btnPreview" value="btnPreview" class="btn btn-primary btn-sm"><i class="fa fa-table"></i> Tampilkan</button>
                              @if ($Lap <> [])
                                  <button type="submit" name="btnExcel" value="btnExcel" class="btn btn-primary btn-sm"><i class="fa fa-file-excel"></i> Download Excel</button>
                              @endif 
                              {{--  <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/aruskas/cetak')}}" formtarget="_blank"><i class="fa fa-print"></i> Cetak Arus Kas</button>  --}}
                            </div>
                          </div>
                        </div>
                      </form> 
                </div>
            </div>
            <div class="card-body">
              @if ($Lap <> [])

                @if ($JnsLap == "1")
                  <table class="table table-striped table-bordered" width="100%" id="tabel-data">
                      <thead>
                        <tr>
                          <th>No. Transaksi</th>
                          <th>Tanggal</th>
                          <th>Nama Anggota</th>
                          <th>Pembayaran</th>
                          <th>Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $Total = 0;
                        @endphp
                        @foreach ($Lap as $k)
                            <tr>
                              <td>{{  $k->no_trx }}</td>
                              <td>{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d-M-Y') }}</td>
                              <td>{{ $k->nama_anggota }}</td>
                              <td>{{ $k->pembayaran }}</td>
                              <td align="right">{{ number_format($k->total,2) }}</td>
                              <td>
                                <a href="{{ url('admin/purchasing/detail/' . $k->id) }}"
                                  data-toggle="tooltip" data-placement="top" title="Detail">
                                  <i class="fa fa-fw fa-info-circle"></i></a>
                              </td>
                            </tr>
                            @php
                              $Total += $k->total;
                            @endphp
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr style="font-style: bold">
                          <th colspan="4" style="font-align: center">T O T A L</th>
                          <th><div align="right">{{ number_format($Total,2) }}</div></th>
                          <th></th>
                        </tr>
                      </tfoot>
                  </table>   
                @else
                  <table class="table table-striped table-bordered" width="100%" id="tabel-data">
                    <thead>
                      <tr>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Margin</th>
                        {{--  <th></th>  --}}
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $Total = 0;
                      @endphp
                      @foreach ($Lap as $k)
                        <tr>
                          <td>{{  $k->nama_barang }}</td>
                          <td align="right">{{ number_format($k->qty,0) }}</td>
                          <td align="right">{{ number_format($k->hpp,2) }}</td>
                          <td align="right">{{ number_format($k->harga,2) }}</td>
                          <td align="right">{{ number_format($k->margin,2) }}</td>
                        </tr>
                        @php
                          $Total += $k->margin;
                        @endphp
                      @endforeach                    
                    </tbody>
                    <tfoot>
                      <tr style="font-style: bold">
                        <th colspan="4" style="font-align: center">T O T A L</th>
                        <th><div align="right">{{ number_format($Total,2) }}</div></th>
                      </tr>
                    </tfoot>
                  </table>
                @endif
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
