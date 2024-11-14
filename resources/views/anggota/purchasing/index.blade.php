@extends('layouts_anggota.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pesanan</h3>
                    <div class="card-options">
                        <blockquote class="blockquote">
                            <h4>{{ $NamaAgt }}</h4>
                            <h5>{{ $Perush }}</h5>
                        </blockquote>


                    </div>
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
                            <table id="tabel-data" class="table table-striped table-bordered" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
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
                                            <td>{{ $all->pembayaran }}</td>
                                            <td>Rp {{ number_format($all->total) }}</td>
                                            <td>
                                                {{--  {{ $all->status_order }}  --}}
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
                                                <a href="{{ url('anggota/purchasing/detail/'.$all->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Lihat Pesanan">
                                                    <i class="fa fa-fw fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{--  Menunggu Konfirmasi  --}}
                        <div class="tab-pane fade show" id="nav-menunggu" role="tabpanel"
                            aria-labelledby="nav-menunggu-tab">
                            <table id="tabel-data-2" class="table table-striped table-bordered" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
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
                                            <td>{{ $wait->pembayaran }}</td>
                                            <td>Rp {{ number_format($wait->total) }}</td>
                                            <td>
                                                {{--  {{ $all->status_order }}  --}}
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
                                                <a href="{{ url('anggota/purchasing/detail/'.$wait->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Lihat Pesanan">
                                                    <i class="fa fa-fw fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{--  Sedang di proses  --}}
                        <div class="tab-pane fade show" id="nav-proses" role="tabpanel" aria-labelledby="nav-proses-tab">
                            <table id="tabel-data-3" class="table table-striped table-bordered" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
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
                                                <a href="{{ url('anggota/purchasing/detail/'.$proses->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Lihat Pesanan">
                                                    <i class="fa fa-fw fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{--  Selesai  --}}
                        <div class="tab-pane fade show" id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab">
                            <table id="tabel-data-4" class="table table-striped table-bordered" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
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
                                                <a href="{{ url('anggota/purchasing/detail/'.$selesai->id) }}"
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
@endsection
