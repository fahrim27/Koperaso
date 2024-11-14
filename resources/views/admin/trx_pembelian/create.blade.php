@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaksi Pembelian</h3>
                    <div class="card-options">

                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/pembelian/add_item') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            @if ($errors->any('id_produk'))
                                <div class="form-group has-error col-md-10">
                                @else
                                    <div class="form-group col-md-10">
                            @endif
                            <label class="form-label">Nama Barang</label>
                            <select class="js-example-basic-single w-100" name="id_produk" id="single2">
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($MsProduk as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="help-block text-red">{{ $errors->first('id_produk') }}</span>

                        @if ($errors->any('qty'))
                            <div class="form-group has-error col-md-2">
                            @else
                                <div class="form-group col-md-2">
                        @endif
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="qty" id="" class="form-control">
                        <span class="help-block text-red">{{ $errors->first('qty') }}</span>
                </div>
            </div>
            <div class="row pull-right">
                <div class="form-group col-md-2">
                    <label class="form-label">&nbsp;</label>
                    {{--  <a href="{{ route('add.item',  $p->id) }}" class="btn btn-primary btn-md"><i class="fa fa-fw fa-cart-plus"></i></a>  --}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" name="btnSubmit" value="additem" class="btn btn-primary btn-sm"><i
                            class="fa fa-fw fa-cart-plus"></i> Tambah</button>
                </div>
            </div>

            <table class="table table-striped table-hover"="100%" cellspacing="0">
                <thead>
                    <tr align="center">
                        <th style:"width:55%">Nama Barang</th>
                        <th style:"width:10%;">Harga</th>
                        <th style:"text-align:center;">Jumlah</th>
                        <th style:"width:22%">Subtotal</th>
                        <th style:"width:10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($TmpCart as $id => $details)
                        @php
                            $total += $details->Produk->harga_beli * $details->jumlah;
                        $no++; @endphp
                        <tr data-id="{{ $id }}">
                            <td data-th="Nama Produk">
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs"><img
                                            src="{{ asset('public/images') }}/{{ $details->Produk->foto }}" width="200"
                                            height="200" /></div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ substr($details->Produk->nama_barang, 0, 25) }}
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Harga" class="text-right"> Rp.
                                {{ number_format($details->Produk->harga_beli) }}
                                <input type="hidden" name="harga{{ $details->id }}" id="harga-{{ $details->id }}"
                                    value="{{ $details->Produk->harga_beli }}">
                            </td>
                            <td data-th="Quantity">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <a href="{{ url('admin/pembelian/decrease/' . $details->id) }}" <button
                                            class="btn btn-danger btn-xs">
                                            <i class="fa fa-fw fa-minus"></i> </button></a>
                                    </div>
                                    <input id="input-quantity-{{ $details->id }}" type="number" disabled
                                        class="form-control" value="{{ $details->jumlah }}" style="width: 80px;">
                                    <div class="input-group-append">
                                        <a href="{{ url('admin/pembelian/increase/' . $details->id) }}" <button
                                            class="btn btn-primary btn-xs"><i class="fa fa-fw fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Subtotal" class="text-right">
                                Rp {{ number_format($details->Produk->harga_beli * $details->jumlah) }}
                            </td>
                            <td>
                                <a href="#modalhapus" onclick="$('#idhapus').val({{ $details->id }})" data-toggle="modal"
                                    title="Hapus Barang" class="btn btn-sm"><i class="fa fa-fw fa-trash"
                                        style="color:red;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right">
                            <h3><strong>Total &nbsp;&nbsp;&nbsp; Rp {{ number_format($total) }}</strong></h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <a href="{{ url('admin/pembelian/checkout_pembayaran') }}"
                                class="btn btn-success btn-sm">Lanjutkan
                                Pembayaran <i class="fa fa-angle-right"></i> </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
            </form>

        </div>

    </div>
    <div class="card-footer">
        <div class="col-md-10">
            {{--  <div class="pull-right">
                <button type="submit" name="btnSubmit" value="posting" class="btn btn-primary btn-sm"><i
                        class="fa fa-fw fa-save"></i> Lanjut Pembayaran</button>
            </div>  --}}
        </div>
    </div>
    </div>
    </form>

    </div>
@endsection
