@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Non Kas (Memorial)</h3>
                <div class="card-options">
                    <div class="card-options">
                        <form action="{{url('admin/memorial/filter')}}" method="POST">
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
                                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-table"></i> Tampilkan</button>
                                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                                  <a href="{{ url('/admin/memorial/addnew') }}" >
                                  <button type="button" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i> Tambah Transaksi</button></a>
                                </div>
                              </div>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="#tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No Transaksi</th>
                            {{-- <th>Kode Akun</th> --}}
                            <th>Nama Akun</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Memo as $Akt)
                        <tr>
                            <td>
                                {{ $Akt->tanggal }}
                            </td>
                            <td>
                                {{ $Akt->no_bukti }}
                            </td>
                            {{-- <td>
                                {{ $Akt->kde_akun }}
                            </td> --}}
                            <td>
                                @if ($Akt->pos_akun == 1)
                                    {{ $Akt->nma_akun }}
                                @else
                                    &nbsp;&nbsp;{{ $Akt->nma_akun }}
                                @endif
                            </td>
                            <td>
                                {{ $Akt->keterangan }}
                            </td>
                            <td align="right">
                                {{ number_format($Akt->debet,2) }}
                            </td>
                            <td align="right">
                                {{ number_format($Akt->kredit,2) }}
                            </td>
                            <td>
                                <div class="pull-right">
                                    <a href="#modelhapus" onclick="$('#idhapus').val({{$Akt->id}})" data-toggle="modal" data-placement="top"  title="Hapus Akun">
                                        <i class="fa fa-fw fa-trash text-danger"></i></a></div>
                              </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modelhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Hapus Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah transaksi tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/memorial/hapus')}}" method="POST">
            <input type="hidden" id="idhapus" name="id" value="">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-primary" value="Hapus">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
