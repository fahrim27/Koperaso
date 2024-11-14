@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Nominatif Simpanan</h3>
                <div class="card-options">
                    <form action="{{url('admin/lap_simpanan/preview')}}" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Filter Simpanan</label>
                                    <select class="js-example-basic-single w-100" name="kdesimp" id="single"
                                        autofocus>
                                        <option value="">-- Pilih Simpanan --</option>
                                        @foreach ($SimpMaster as $s)
                                            <option value="{{ $s->id }}" {{ $IdSimp == $s->id ? 'selected' : ''}}>{{ $s->nama }}</option>
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
                                    <input type="radio" class="form-check-input" name="jns_lap" id="rekap" value="1"  data-description="Rekap Simpanan" {{ $JnsLap=="1" ? "checked" : "" }}>
                                    Rekap Simpanan
                                  </label>
                                </div>
                              </div>
                              <div class="col-sm-5">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jns_lap" id="detail" value="2" data-description="Detail Simpanan" {{ $JnsLap=="2" ? "checked" : "" }}>
                                    Detail Simpanan
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
                              @if ($LapSimp <> [])
                                  <button type="submit" name="btnExcel" value="btnExcel" class="btn btn-primary btn-sm"><i class="fa fa-file-excel"></i> Download Excel</button>
                              @endif 
                            </div>
                          </div>
                        </div>
                      </form> 
                </div>
            </div>
            <div class="card-body">
                @if ($LapSimp<>[])
                    @if ($JnsLap=="1")
                        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Simpanan</th>
                                    <th>Total Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $Total = 0;
                                @endphp
                                @foreach ($LapSimp as $k)
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
                        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No. Rekening</th>
                                    <th>Nama Anggota</th>
                                    <th>Nama Simpanan</th>
                                    <th>Nominal Setoran</th>
                                    <th>Saldo Simpanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $TotalSimp = 0;
                                @endphp
                                @foreach ($LapSimp as $Simp)
                                    <tr>
                                        <td>
                                            {{ $Simp->no_rek }}
                                        </td>
                                        <td>
                                            {{ $Simp->Anggota->nama_anggota }}
                                        </td>
                                        <td>
                                            {{ $Simp->SimpMaster->nama }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($Simp->setoran) }}
                                        </td>
                                        <td align="right">
                                            Rp {{ number_format($Simp->saldo_akhir, 2) }}
                                        </td>
                                    </tr>
                                    @php
                                        $TotalSimp += $Simp->saldo_akhir;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">T O T A L </th>
                                    <th><div align="right">   {{ number_format($TotalSimp,2) }}</div></th>
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
