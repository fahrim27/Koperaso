@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Produk</h3>
                <div class="card-options">
                    <a href="{{ url('/admin/master_produk/addnew') }}" class="btn btn-sm btn-pill btn-primary">Tambah Produk</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            {{--  <th>Skema Pembayaran</th>  --}}
                            <th>Status</th>
                            <th>Jml Stok</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Produk as $p)
                            <tr>
                                <td>{{ $p->Kategori->kategori }}</td>
                                <td>{{  $p->nama_barang }}</td>
                                <td>Rp. {{ number_format($p->harga_beli,2) }}</td>
                                <td>Rp. {{ number_format($p->harga_jual,2)  }}</td>
                                {{--  <td>
                                  @if ($p->cicilan=="Y")
                                    <div class="badge badge-warning">Cicilan</div>
                                  @endif
                                  &nbsp;
                                  @if ($p->bayar_penuh=="Y")
                                    <div class="badge badge-info">Bayar Penuh</div>
                                  @endif
                                </td>  --}}
                                <td>{{ $p->status }}</td>
                                <td>
                                  {{ $p->stok }}
                                </td>
                                <td>
                                    <a href="{{ url('admin/master_produk/detail/'.$p->id) }}" data-toggle="tooltip" data-placement="top" title="Detail">
                                        <i class="fa fa-fw fa-info-circle"></i></a>

                                    <a href="{{ url('admin/master_produk/edit/'.$p->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-fw fa-edit"></i></a>
    
                                      <a href="#modelhapus" onclick="$('#idhapus').val({{$p->id}})" data-toggle="modal" data-placement="top"  title="Hapus">
                                      <i class="fa fa-fw fa-trash"></i></a>
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
          <h5 class="modal-title" id="myModalLabel">Hapus Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah produk tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/master_produk/hapus')}}" method="POST">
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
