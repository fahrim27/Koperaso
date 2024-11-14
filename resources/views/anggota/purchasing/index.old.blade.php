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
                <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>   
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Ket. Batal</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($JbOrder as $p)
                      <tr>
                          <td>{{ $p->no_trx }}</td>
                          <td>{{ $p->tanggal }}</td>
                          <td>{{ $p->MsProduk->nama_barang }}</td>
                          <td align="right">Rp. {{ number_format($p->harga,2) }}</td>
                          <td align="center">{{ $p->qty }}</td>
                          <td align="right">Rp. {{ number_format($p->harga*$p->qty,2) }}</td>
                          <td>{{ $p->pembayaran }}  {{ $p->pembayaran=="Cicilan" ? '12x' : '' }}</td>
                          <td>
                            @switch($p->status_order)
                                        @case("Menunggu Konfirmasi")
                                          <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                          @break
                                        @case("Diproses")
                                          <div class="badge badge-info">Diproses</div>
                                          @break
                                        @case("Siap Diambil")
                                          <div class="badge badge-primary">Siap Diambil</div>
                                          @break
                                        @case("Selesai")
                                          <div class="badge badge-success">Selesai</div>
                                          @break
                                        @case("Dibatalkan")
                                          <div class="badge badge-danger">Dibatalkan</div>
                                          @break                                          
                                    @endswitch
                          </td>
                          <td>
                            {{ $p->ket_batal }}
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
          <h5 class="modal-title" id="myModalLabel">Hapus Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah akun tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/master_akun/hapus')}}" method="POST">
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
