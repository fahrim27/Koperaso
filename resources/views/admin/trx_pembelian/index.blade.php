@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pembelian</h3>
                    <div class="card-options">
                        <a href="{{ url('/admin/pembelian/addnew') }}" class="btn btn-primary btn-sm"><i
                            class="fa fa-file"></i> Tambah Transaksi</a>
                    </div>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all"
                                role="tab" aria-controls="nav-all" aria-selected="true">Semua Pembelian</a>

                            {{--  <a class="nav-item nav-link" id="nav-menunggu-tab" data-toggle="tab" href="#nav-menunggu"
                                role="tab" aria-controls="nav-menunggu" aria-selected="false">Menunggu</a>

                            <a class="nav-item nav-link" id="nav-setuju-tab" data-toggle="tab" href="#nav-setuju"
                                role="tab" aria-controls="nav-setuju" aria-selected="false">Disetujui</a>

                            <a class="nav-item nav-link" id="nav-tolak-tab" data-toggle="tab" href="#nav-tolak"
                                role="tab" aria-controls="nav-tolak" aria-selected="false">Ditolak</a>  --}}
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        {{--  Semua Pesanan  --}}
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                            <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th width="60%">Suplier</th>
                                        <th>Pembayaran</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($TrxBeli as $p)
                                        <tr>
                                            <td>{{ $p->tanggal }}</td>
                                            <td>{{ $p->MsSuplier->nama_suplier }}</td>
                                            <td>{{ $p->pembayaran }}</td>
                                            <td>Rp {{ number_format($p->total) }}</td>
                                            <td>
                                                @switch($p->status)
                                                    @case('Menunggu')
                                                        <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                                    @break

                                                    @case('Disetujui')
                                                        <div class="badge badge-success">Disetujui</div>
                                                    @break

                                                    @case('Ditolak')
                                                        <div class="badge badge-danger">Ditolak</div>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <a href="#modelsetuju" onclick="$('#idsetuju').val({{ $p->id }})"
                                                    data-toggle="modal" data-placement="top" title="Setujui Transaksi">
                                                    <i class="fa fa-fw fa-check-circle text-success"></i></a>
                                                <a href="#modelhapus" onclick="$('#idhapus').val({{ $p->id }})"
                                                    data-toggle="modal" data-placement="top" title="Hapus Transaksi">
                                                    <i class="fa fa-fw fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--  Menunggu  --}}
                        <div class="tab-pane fade show" id="nav-menunggu" role="tabpanel" aria-labelledby="nav-menunggu-tab">
                            menunggu
                        </div>

                        {{--  Setujui  --}}
                        <div class="tab-pane fade show" id="nav-setuju" role="tabpanel" aria-labelledby="nav-setuju-tab">
                            Setuju
                        </div>
                        {{--  TOlak  --}}
                        <div class="tab-pane fade show" id="nav-tolak" role="tabpanel" aria-labelledby="nav-tolak-tab">
                            Tolak
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modelsetuju" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Setujui Transaksi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Apakah transaksi tersebut akan disetujui ?
            </div>
            <div class="modal-footer">
              <form action="{{url('admin/pembelian/setuju')}}" method="POST">
                <input type="hidden" id="idsetuju" name="id" value="">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" value="Setuju">
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
              <form action="{{url('admin/pembelian/hapus')}}" method="POST">
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
    <!-- /.modal-dialog -->
@endsection
