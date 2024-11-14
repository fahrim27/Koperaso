@extends('layouts_anggota.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Keranjang Belanja</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-responsive" width="100%" cellspacing="0">
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
                            {{--  @if ($Cart != [])  --}}
                            @foreach ($Cart as $id => $details)
                                @php
                                $total += $details->Produk->harga_jual*$details->jumlah;
                                $no++; @endphp
                                <tr data-id="{{ $id }}">
                                    <td data-th="Nama Produk">
                                        <div class="row">
                                            <div class="col-sm-3 hidden-xs"><img
                                                    src="{{ asset('public/images') }}/{{ $details->Produk->foto }}"
                                                    width="200" height="200" /></div>
                                            <div class="col-sm-9">
                                                <h4 class="nomargin">{{ substr($details->Produk->nama_barang, 0, 25) }}
                                                </h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Harga" class="text-right"> Rp.
                                        {{ number_format($details->Produk->harga_jual) }}
                                        <input type="hidden" name="harga{{ $details->id }}" id="harga-{{ $details->id }}"
                                            value="{{ $details->Produk->harga_jual }}">
                                    </td>
                                    <td data-th="Quantity">
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-danger btn-xs"
                                                    onclick="decreaseQty({{ $details->id }});"> <i
                                                        class="fa fa-fw fa-minus"></i> </button>
                                            </div>
                                            <input id="input-quantity-{{ $details->id }}" type="number" disabled
                                                class="form-control" value="{{ $details->jumlah }}" style="width: 80px;">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary btn-xs"
                                                    onclick="increaseQty({{ $details->id }});"><i
                                                        class="fa fa-fw fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Subtotal" class="text-right">
                                        Rp {{ number_format($details->Produk->harga_jual * $details->jumlah) }}
                                    </td>
                                    <td>
                                        <a href="#modalhapus" onclick="$('#idhapus').val({{ $details->id }})"
                                            data-toggle="modal" title="Hapus Barang" class="btn btn-sm"><i
                                                class="fa fa-fw fa-trash" style="color:red;"></i></a>
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
                                    <a href="{{ url('anggota/purchasing/catalog') }}" class="btn btn-warning btn-sm"><i
                                            class="fa fa-angle-left"></i> Lanjutkan Belanja</a>
                                    <a href="{{ url('anggota/purchasing/checkout') }}"
                                        class="btn btn-success btn-sm">Lanjutkan Pembayaran <i
                                            class="fa fa-angle-right"></i> </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Hapus Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah barang tersebut akan dihapus dari keranjang belanja ?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('remove.from.cart') }}" method="POST">
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
