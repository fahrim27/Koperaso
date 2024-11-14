@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pembayaran Transaksi Pembelian</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/pembelian/posting') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            @if ($errors->any('tanggal'))
                                <div class="form-group has-error col-md-4">
                                @else
                                    <div class="form-group col-md-4">
                            @endif
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            <span class="help-block">{{ $errors->first('tanggal') }}</span>
                        </div>
                        @if ($errors->any('id_suplier'))
                            <div class="form-group has-error col-md-8">
                            @else
                                <div class="form-group col-md-8">
                        @endif
                        <label class="form-label">Nama Suplier</label>
                        <select class="js-example-basic-single w-100" name="id_suplier" id="single" autofocus>
                            <option value="">-- Pilih Suplier --</option>
                            @foreach ($MsSuplier as $k)
                                <option value="{{ $k->id }}"
                                    {{ Request::old('id_suplier') == $k->id ? 'selected' : '' }}>{{ $k->nama_suplier }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block">{{ $errors->first('id_suplier') }}</span>
                </div>
            </div>
            <div class="row">
                @if ($errors->any('pembayaran'))
                    <div class="form-group has-error col-md-4">
                    @else
                        <div class="form-group col-md-4">
                @endif
                <label class="form-label">Pembayaran Ke</label>
                <input type="text" name="pembayaran" id="" value="{{ Request::old('pembayaran') }}" class="form-control">
                {{--  <select class="js-example-basic-single w-100" name="pembayaran" id="single3" autofocus>
                    <option value="">-- Pilih Pembayaran --</option>
                    <option value="Tunai" {{ Request::old('pembayaran') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                    <option value="Transfer Bank" {{ Request::old('pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>
                        Transfer Bank</option>

                </select>  --}}
                <span class="help-block">{{ $errors->first('pembayaran') }}</span>
            </div>

            <div class="form-group col-md-8">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" id="" value="{{ Request::old('keterangan') }}"
                    class="form-control">
            </div>
        </div>
        <h3>Ringkasan Pesanan</h3>
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

                    @foreach ($TmpCart as $p)
                        @php $total += $p->Produk->harga_beli * $p->jumlah @endphp
                        <tr class="text-right">
                            <td class="text-left">{{ $p->Produk->nama_barang }}</td>
                            <td>Rp {{ number_format($p->Produk->harga_beli) }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>Rp {{ number_format($p->Produk->harga_beli * $p->jumlah) }}</td>
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
        <div class="float-right">
            <input type="hidden" name="total" value="{{ $total }}">
        <button type="submit" class="btn btn-primary btn-sm"><i
            class="fa fa-fw fa-save"></i> Simpan</button>
        </div>
    </div>
    </form>
    </div>
    </div>
    </div>
@endsection
