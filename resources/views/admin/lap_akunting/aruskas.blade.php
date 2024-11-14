@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Arus KAS</h3>
                <div class="card-options">
                    <form action="{{url('admin/lap_akunting/aruskas')}}" method="POST">
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
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/aruskas')}}"><i class="fa fa-table"></i> Tampilkan</button>
                              <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/aruskas/cetak')}}" formtarget="_blank"><i class="fa fa-print"></i> Cetak Arus Kas</button>
                            </div>
                          </div>
                        </div>
                      </form> 
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" width="50%" >
                    <tr>
                        <th>Keterangan</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Saldo Akhir</th>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Saldo Awal Kas</b></td>
                        <td>Rp. {{ number_format($SaldoAwal,2) }}</td>
                    </tr>
                    <tr>
                        <td><b>Mutasi Kas</b></td>
                        <td><b>Rp. {{ number_format($Masuk,2) }}</b></td>
                        <td><b>Rp. {{ number_format($Keluar,2) }}</b></td>
                        <td><b>Rp. {{ number_format($SaldoAkhir,2) }}</b></td>
                    </tr>
                </table>
                @if ($ArusKas <> [])
                
                <br><br>
                <table id="#" class="table table-striped table-bordered" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Tanggal</th>
                          <th>No Transaksi</th>
                          <th>Pemasukan</th>
                          <th>Pengeluaran</th>
                          <th>Keterangan</th>                            
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($ArusKas as $Akt)
                    <tr>
                        <td>
                            {{ $Akt->tanggal }}
                        </td>
                        <td>
                            {{ $Akt->no_bukti }}
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
                    <tr style="font-weight: bold">
                        <td colspan="2" align="center">T O T A L</td>
                        <td align="right">{{ number_format($Masuk,2) }}</td>
                        <td align="right">{{ number_format($Keluar,2) }}</td>
                        <td></td>
                    </tr>
                  </tbody>
              </table>                  
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
