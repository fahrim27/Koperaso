@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Nominatif Pinjaman</h3>
                <div class="card-options">
                    <form action="{{url('admin/lap_pinjaman/preview')}}" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Filter Pinjaman</label>
                                    <select class="js-example-basic-single w-100" name="kdepby" id="single"
                                        autofocus>
                                        <option value="">-- Pilih Pinjaman --</option>
                                        @foreach ($PbyMaster as $s)
                                            <option value="{{ $s->id }}" {{ $IdPby == $s->id ? 'selected' : ''}}>{{ $s->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="">Tampilkan Laporan</label>
                          <div class="row col-md-8">
                            <div class="col-sm-4">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jns_lap" id="rekap" value="1"  data-description="Rekap Pinjaman" {{ $JnsLap=="1" ? "checked" : "" }}>
                                    Rekap Pinjaman
                                  </label>
                                </div>
                              </div>
                              <div class="col-sm-5">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jns_lap" id="detail" value="2" data-description="Detail per Rekening" {{ $JnsLap=="2" ? "checked" : "" }}>
                                    Detail Pinjaman
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
                              @if ($LapPby <> [])
                                  <button type="submit" name="btnExcel" value="btnExcel" class="btn btn-primary btn-sm"><i class="fa fa-file-excel"></i> Download Excel</button>
                              @endif 
                            </div>
                          </div>
                        </div>
                      </form> 
                </div>
            </div>
            <div class="card-body">
                @if ($LapPby<>[])
                    @if ($JnsLap=="1")
                        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Pinjaman</th>
                                    <th>Total Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $Total =0;
                                @endphp
                                @foreach ($LapPby as $k)
                                    <tr>
                                        <td>{{ $k->nama }}</td>
                                        <td align="right">{{ number_format($k->saldo,2) }}</td>
                                    </tr>
                                    @php
                                        $Total += $k->saldo;
                                    @endphp
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>T O T A L </th>
                                    <th><div align="right">   {{ number_format($Total,2) }}</div></th>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No. Rekening</th>
                                    <th>Nama Anggota</th>
                                    <th>Nama Pinjaman</th>
                                    <th>Plafond</th>
                                    <th>Tgl Cair</th>
                                    <th>Tenor</th>
                                    <th>Jth Tempo</th>
                                    <th>Angs ke- </th>
                                    <th>Saldo Pinjaman</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $Total =0;
                                @endphp
                                @foreach ($LapPby as $k)
                                    <tr>
                                        <td>{{ $k->no_rek }}</td>
                                        <td>{{ $k->nama_anggota }}</td>
                                        <td>{{ $k->nama }}</td>
                                        <td align="right">{{ number_format($k->plafond,0) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($k->tgl_cair)->translatedFormat('d-M-Y') }}</td>
                                        <td>{{ $k->jangka }}</td>
                                        <td>{{ \Carbon\Carbon::parse($k->jth_tempo)->translatedFormat('d-M-Y') }}</td>
                                        <td>{{ $k->angske }}</td>
                                        <td align="right">{{ number_format($k->saldo_akhir,2) }}</td>
                                    </tr>
                                    @php
                                        $Total += $k->saldo_akhir;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="8">T O T A L </th>
                                    <th><div align="right">   {{ number_format($Total,2) }}</div></th>
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
