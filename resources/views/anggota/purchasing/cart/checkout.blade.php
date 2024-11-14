@extends('layouts_anggota.app')
@section('content-app')
    @include('message.flash')
    <form action="{{ url('anggota/purchasing/pembayaran_checkout') }}" method="post">
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ringkasan Pesanan</h3>
                    </div>
                    <div class="card-body">
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

                                    @foreach ($Cart as $p)
                                        @php $total += $p->Produk->harga_jual * $p->jumlah @endphp
                                        <tr class="text-right">
                                            <td class="text-left">{{ $p->Produk->nama_barang }}</td>
                                            <td>Rp {{ number_format($p->Produk->harga_jual) }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                            <td>Rp {{ number_format($p->Produk->harga_jual * $p->jumlah) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <div class="form-group col-md-12">
                                                <input type="text" name="notes" class="form-control"
                                                    placeholder="Catatan...">
                                            </div>
                                        </td>
                                        <td colspan="3" class="text-right">
                                            <h3><strong>Total &nbsp;&nbsp;&nbsp; Rp {{ number_format($total) }}</strong>
                                            </h3>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if ($errors->any('pembayaran'))
                            <div class="form-group has-error col-md-6">
                            @else
                                <div class="form-group col-md-6">
                        @endif
                        <h3 class="card-title">Pilih Metode Pembayaran</h3>
                        <select class="js-example-basic-single w-100" name="pembayaran" id="single3" autofocus>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Bayar Nanti (PG)">Bayar Nanti (PG)</option>
                            @if ($total > 500000)
                                <option value="Cicilan 3x">Cicilan 3x --- <small class="text-info"> Rp.
                                        {{ number_format($total / 3, 2) }}</small></option>
                                <option value="Cicilan 6x">Cicilan 6x --- <small class="text-info"> Rp.
                                        {{ number_format($total / 6, 2) }}</small></option>
                                <option value="Cicilan 12x">Cicilan 12x --- <small class="text-info"> Rp.
                                        {{ number_format($total / 12, 2) }}</small></option>
                            @endif
                        </select>
                        <span class="help-block">{{ $errors->first('pembayaran') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Proses
                            Pesanan</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal fade" id="modelhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Hapus Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah akun tersebut akan dihapus ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/master_akun/hapus') }}" method="POST">
                        <input type="hidden" id="idhapus" name="id" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
