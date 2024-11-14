@extends('layouts.app')
@section('content-app')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Barang</h3>
                    <div class="card-options">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-people mt-auto">
                                <img src="{{ asset('public/images') }}/{{ $Produk->foto }}" alt="people">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <table id="#" class="table table-striped table-hover" width="100%" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td width="20%">Kategori</td>
                                        <td>:</td>
                                        <td>{{ $Produk->Kategori->kategori }}
                                        <td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Nama Barang</td>
                                        <td width="5%">:</td>
                                        <td>{{ $Produk->nama_barang }}
                                        <td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Harga Barang</td>
                                        <td width="5%">:</td>
                                        <td> Rp. {{ number_format($Produk->harga_jual) }}
                                        <td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Status</td>
                                        <td width="5%">:</td>
                                        <td> {{ $Produk->status }}
                                        <td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Deskripsi</td>
                                        <td width="5%">:</td>
                                        <td>
                                            <blockquote>
                                                {{ $Produk->deskripsi }}</blockquote>
                                        <td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Stok Barang</td>
                                        <td width="5%">:</td>
                                        <td> {{ $Produk->stok }}
                                        <td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="tabel-data" class="table table-striped table-bordered" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%">Tanggal</th>
                                        <th>Keterangan</th>
                                        <th width="15%">Jml Masuk</th>
                                        <th width="15%">Jml Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Mutasi as $m)
                                        <tr>
                                            <td>{{ $m->tanggal }}</td>
                                            <td>{{ $m->keterangan }}</td>
                                            <td>{{ $m->masuk }}</td>
                                            <td>{{ $m->keluar }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i
                                        class="fa fa-reply"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tolak Pengajuan Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pengajuan pinjaman tersebut akan ditolak ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/pengajuan/update') }}" method="POST">
                        <input type="hidden" id="idtolak" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Ditolak">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-danger" value="Tolak Pengajuan">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modalsetuju" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Setujui Pengajuan Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pengajuan pinjaman tersebut akan distujui ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/pengajuan/update') }}" method="POST">
                        <input type="hidden" id="idsetuju" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Disetujui">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-success" value="Setujui Pengajuan">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
