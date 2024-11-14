@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pesanan</h3>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all"
                                role="tab" aria-controls="nav-all" aria-selected="true">Semua Pesanan</a>

                            <a class="nav-item nav-link" id="nav-menunggu-tab" data-toggle="tab" href="#nav-menunggu"
                                role="tab" aria-controls="nav-menunggu" aria-selected="false">Menunggu</a>

                            <a class="nav-item nav-link" id="nav-proses-tab" data-toggle="tab" href="#nav-proses"
                                role="tab" aria-controls="nav-proses" aria-selected="false">Sedang Diproses</a>

                            <a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab" href="#nav-selesai"
                                role="tab" aria-controls="nav-selesai" aria-selected="false">Selesai</a>

                            <a class="nav-item nav-link" id="nav-batal-tab" data-toggle="tab" href="#nav-batal"
                                role="tab" aria-controls="nav-batal" aria-selected="false">Dibatalkan</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        {{--  Semua Pesanan  --}}
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                            <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nama Anggota</th>
                                        <th>Pembayaran</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($JbOrderAll as $all)
                                        <tr>
                                            <td>{{ $all->no_trx }}</td>
                                            <td>{{ \Carbon\Carbon::parse($all->tanggal)->format('d-m-Y') }}</td>
                                            <td>
                                                {{ $all->Anggota->nama_anggota }}
                                            </td>
                                            <td>{{ $all->pembayaran }}</td>
                                            <td>Rp {{ number_format($all->total) }}</td>
                                            <td>
                                                @switch($all->status_order)
                                                    @case('Menunggu Konfirmasi')
                                                        <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                                    @break

                                                    @case('Menunggu Pembayaran')
                                                        <div class="badge badge-warning">Menunggu Pembayaran</div>
                                                    @break

                                                    @case('Diproses')
                                                        <div class="badge badge-info">Diproses</div>
                                                    @break

                                                    @case('Siap Diambil')
                                                        <div class="badge badge-primary">Siap Diambil</div>
                                                    @break

                                                    @case('Selesai')
                                                        <div class="badge badge-success">Selesai</div>
                                                    @break

                                                    @case('Dibatalkan')
                                                        <div class="badge badge-danger">Dibatalkan</div>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($all->status_order == 'Menunggu Konfirmasi' || $all->status_order == 'Menunggu Pembayaran')
                                                    <a href="#modalproses" onclick="$('#idsetuju').val({{ $all->id }})"
                                                        data-toggle="modal" title="Proses Pesanan">
                                                        <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>
                                                @endif

                                                @if ($all->status_order == 'Diproses')
                                                    <a href="#modalsiap" onclick="$('#idsiap').val({{ $all->id }})"
                                                        data-toggle="modal" title="Siap Diambil">
                                                        <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>
                                                @endif
                                                @if ($all->status_order == 'Siap Diambil')
                                                    <a href="#modalselesai"
                                                        onclick="$('#idselesai').val({{ $all->id }})"
                                                        data-toggle="modal" title="Pesanan Selesai">
                                                        <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>
                                                @endif

                                                @if ($all->status_order != 'Selesai')
                                                    <a href="#modaltolak" onclick="$('#idtolak').val({{ $all->id }})"
                                                        data-toggle="modal" title="Batalkan Pesanan">
                                                        <i class="fa fa-fw fa-times-circle" style="color:red;"></i></a>
                                                @endif


                                                <a href="{{ url('admin/purchasing/detail/' . $all->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Lihat Pesanan">
                                                    <i class="fa fa-fw fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Menunggu Pembayaran/Konfirmasi   --}}
                        <div class="tab-pane fade show" id="nav-menunggu" role="tabpanel"
                            aria-labelledby="nav-menunggu-tab">
                            <table id="tabel-data-2" class="table table-striped table-bordered table-responsive" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nama Anggota</th>
                                        <th>Pembayaran</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($JbOrderWait as $wait)
                                        <tr>
                                            <td>{{ $wait->no_trx }}</td>
                                            <td>{{ \Carbon\Carbon::parse($wait->tanggal)->format('d-m-Y') }}</td>
                                            <td>
                                                {{ $wait->Anggota->nama_anggota }}
                                            </td>
                                            <td>{{ $wait->pembayaran }}</td>
                                            <td>Rp {{ number_format($wait->total) }}</td>
                                            <td>
                                                @switch($wait->status_order)
                                                    @case('Menunggu Konfirmasi')
                                                        <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                                    @break

                                                    @case('Menunggu Pembayaran')
                                                        <div class="badge badge-warning">Menunggu Pembayaran</div>
                                                    @break

                                                    @case('Diproses')
                                                        <div class="badge badge-info">Diproses</div>
                                                    @break

                                                    @case('Siap Diambil')
                                                        <div class="badge badge-primary">Siap Diambil</div>
                                                    @break

                                                    @case('Selesai')
                                                        <div class="badge badge-success">Selesai</div>
                                                    @break

                                                    @case('Dibatalkan')
                                                        <div class="badge badge-danger">Dibatalkan</div>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($wait->status_order == 'Menunggu Konfirmasi' || $wait->status_order == 'Menunggu Pembayaran')
                                                    <a href="#modalproses"
                                                        onclick="$('#idsetuju').val({{ $all->id }})"
                                                        data-toggle="modal" title="Proses Pesanan">
                                                        <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>
                                                @endif

                                                <a href="{{ url('admin/purchasing/detail/' . $wait->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Lihat Pesanan">
                                                    <i class="fa fa-fw fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Diproses   --}}
                        <div class="tab-pane fade show" id="nav-proses" role="tabpanel"
                            aria-labelledby="nav-proses-tab">
                            <table id="tabel-data-3" class="table table-striped table-bordered table-responsive" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nama Anggota</th>
                                        <th>Pembayaran</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($JbOrderProses as $proses)
                                        <tr>
                                            <td>{{ $proses->no_trx }}</td>
                                            <td>{{ \Carbon\Carbon::parse($proses->tanggal)->format('d-m-Y') }}</td>
                                            <td>
                                                {{ $proses->Anggota->nama_anggota }}
                                            </td>
                                            <td>{{ $proses->pembayaran }}</td>
                                            <td>Rp {{ number_format($proses->total) }}</td>
                                            <td>
                                                @switch($proses->status_order)
                                                    @case('Menunggu Konfirmasi')
                                                        <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                                    @break

                                                    @case('Menunggu Pembayaran')
                                                        <div class="badge badge-warning">Menunggu Pembayaran</div>
                                                    @break

                                                    @case('Diproses')
                                                        <div class="badge badge-info">Diproses</div>
                                                    @break

                                                    @case('Siap Diambil')
                                                        <div class="badge badge-primary">Siap Diambil</div>
                                                    @break

                                                    @case('Selesai')
                                                        <div class="badge badge-success">Selesai</div>
                                                    @break

                                                    @case('Dibatalkan')
                                                        <div class="badge badge-danger">Dibatalkan</div>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($proses->status_order == 'Diproses')
                                                    <a href="#modalsiap" onclick="$('#idsiap').val({{ $proses->id }})"
                                                        data-toggle="modal" title="Siap Diambil">
                                                        <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>
                                                @endif

                                                <a href="{{ url('admin/purchasing/detail/' . $proses->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Lihat Pesanan">
                                                    <i class="fa fa-fw fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Siap Diambil  --}}
                        <div class="tab-pane fade show" id="nav-selesai" role="tabpanel"
                            aria-labelledby="nav-selesai-tab">
                            <table id="tabel-data-4" class="table table-striped table-bordered table-responsive" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nama Anggota</th>
                                        <th>Pembayaran</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($JbOrderSelesai as $selesai)
                                        <tr>
                                            <td>{{ $selesai->no_trx }}</td>
                                            <td>{{ \Carbon\Carbon::parse($selesai->tanggal)->format('d-m-Y') }}</td>
                                            <td>
                                                {{ $selesai->Anggota->nama_anggota }}
                                            </td>
                                            <td>{{ $selesai->pembayaran }}</td>
                                            <td>Rp {{ number_format($selesai->total) }}</td>
                                            <td>
                                                @switch($selesai->status_order)
                                                    @case('Menunggu Konfirmasi')
                                                        <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                                    @break

                                                    @case('Menunggu Pembayaran')
                                                        <div class="badge badge-warning">Menunggu Pembayaran</div>
                                                    @break

                                                    @case('Diproses')
                                                        <div class="badge badge-info">Diproses</div>
                                                    @break

                                                    @case('Siap Diambil')
                                                        <div class="badge badge-primary">Siap Diambil</div>
                                                    @break

                                                    @case('Selesai')
                                                        <div class="badge badge-success">Selesai</div>
                                                    @break

                                                    @case('Dibatalkan')
                                                        <div class="badge badge-danger">Dibatalkan</div>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($selesai->status_order == 'Siap Diambil')
                                                    <a href="#modalselesai"
                                                        onclick="$('#idselesai').val({{ $selesai->id }})"
                                                        data-toggle="modal" title="Pesanan Selesai">
                                                        <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>
                                                @endif

                                                <a href="{{ url('admin/purchasing/detail/' . $selesai->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Lihat Pesanan">
                                                    <i class="fa fa-fw fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{-- Batalkan  --}}
                        <div class="tab-pane fade show" id="nav-batal" role="tabpanel"
                            aria-labelledby="nav-batal-tab">
                            <table id="tabel-data-5" class="table table-striped table-bordered table-responsive" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nama Anggota</th>
                                        <th>Pembayaran</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($JbOrderBatal as $batal)
                                        <tr>
                                            <td>{{ $batal->no_trx }}</td>
                                            <td>{{ \Carbon\Carbon::parse($batal->tanggal)->format('d-m-Y') }}</td>
                                            <td>
                                                {{ $batal->Anggota->nama_anggota }}
                                            </td>
                                            <td>{{ $batal->pembayaran }}</td>
                                            <td>Rp {{ number_format($batal->total) }}</td>
                                            <td>
                                                @switch($batal->status_order)
                                                    @case('Menunggu Konfirmasi')
                                                        <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                                    @break

                                                    @case('Menunggu Pembayaran')
                                                        <div class="badge badge-warning">Menunggu Pembayaran</div>
                                                    @break

                                                    @case('Diproses')
                                                        <div class="badge badge-info">Diproses</div>
                                                    @break

                                                    @case('Siap Diambil')
                                                        <div class="badge badge-primary">Siap Diambil</div>
                                                    @break

                                                    @case('Selesai')
                                                        <div class="badge badge-success">Selesai</div>
                                                    @break

                                                    @case('Dibatalkan')
                                                        <div class="badge badge-danger">Dibatalkan</div>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($batal->status_order == 'Siap Diambil')
                                                    <a href="#modalselesai"
                                                        onclick="$('#idselesai').val({{ $batal->id }})"
                                                        data-toggle="modal" title="Pesanan Selesai">
                                                        <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>
                                                @endif

                                                <a href="{{ url('admin/purchasing/detail/' . $batal->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Lihat Pesanan">
                                                    <i class="fa fa-fw fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{ url('admin/purchasing/update') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Batalkan Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Alasan Pembatalan</label>
                            <input type="text" name="keterangan"class="form-control">
                            <span class="help-block">{{ $errors->first('keterangan') }}</span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idtolak" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Dibatalkan">
                        <input type="hidden" name="sts_hr" value="Ditolak HR">
                        <input type="hidden" name="sts_cfo" value="Ditolak CFO">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-danger" value="Batalkan Pesanan">

                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modalproses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Proses Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pesanan tersebut akan diproses ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/purchasing/update') }}" method="POST">
                        <input type="hidden" id="idsetuju" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Diproses">


                        <input type="hidden" name="keterangan" value="">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-success" value="Proses Pesanan">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modalsiap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Pesanan Siap Diambil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pesanan tersebut akan sudah siap diambil ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/purchasing/update') }}" method="POST">
                        <input type="hidden" id="idsiap" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Siap Diambil">
                        <input type="hidden" name="keterangan" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-success" value="Siap Diambil">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modalselesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Pesanan Selesai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pesanan tersebut akan diselesaikan ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/purchasing/update') }}" method="POST">
                        <input type="hidden" id="idselesai" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Selesai">
                        <input type="hidden" name="keterangan" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-success" value="Pesanan Selesai">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
