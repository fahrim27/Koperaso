@extends('layouts_anggota.app')
@section('content-app')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pesanan</h3>
                    <div class="card-options">
                        <div class="row">
                            <div class="col-md-6">
                                <table width="100%">
                                    <tr>
                                        <td width="40%">No. Pesanan</td>
                                        <td width="5%">:</td>
                                        <td width="50%">{{ $JbOrder->no_trx }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>{{ \Carbon\Carbon::parse($JbOrder->tanggal)->translatedFormat('d F Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table width="100%">
                                    <tr>
                                        <td width="40%">Pembayaran</td>
                                        <td width="5%">:</td>
                                        <td width="50%">{{ $JbOrder->pembayaran }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Pesanan</td>
                                        <td>:</td>
                                        <td>
                                            @switch($JbOrder->status_order)
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
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    {{--  <h3>Detail Pesanan</h3>  --}}
                    <div class="table-responsive w-100">
                        <table class="table">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>Nama Barang</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Jml Barang</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp

                                @foreach ($DetailOrder as $p)
                                    @php $total += $p->harga * $p->qty @endphp
                                    <tr class="text-right">
                                        <td class="text-left">{{ $p->MsProduk->nama_barang }}</td>
                                        <td>Rp {{ number_format($p->harga) }}</td>
                                        <td>{{ $p->qty }}</td>
                                        <td>Rp {{ number_format($p->harga * $p->qty) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right">
                                        <h3><strong>Total &nbsp;&nbsp;&nbsp; Rp {{ number_format($total) }}</strong>
                                        </h3>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                  <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <input type="text" name="ket_batal"class="form-control">
                            <span class="help-block">{{ $errors->first('ket_batal') }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idtolak" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Dibatalkan">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-danger" value="Batalkan Pesanan">
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    </form>
    <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modalsetuju" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    Apakah pesanan tersebut akan diproses?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/purchasing/update') }}" method="POST">
                        <input type="hidden" id="idsetuju" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Diproses">
                        <input type="hidden" name="ket_batal" value="">
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
                    <h5 class="modal-title" id="myModalLabel">Selesaikan Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pesanan tersebut akan diselesaikan?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/purchasing/update') }}" method="POST">
                        <input type="hidden" id="idsiap" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Siap Diambil">
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

    <div class="modal fade" id="modaldone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Selesaikan Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pesanan tersebut akan diselesaikan?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/purchasing/update') }}" method="POST">
                        <input type="hidden" id="iddone" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Selesai">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-success" value="Selesaikan Pesanan">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
