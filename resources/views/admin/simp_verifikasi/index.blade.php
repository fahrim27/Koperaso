@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Simpanan Anggota</h3>
                <div class="card-options">
                    {{--  <a href="{{ url('/admin/simp_mutasi/addnew') }}" class="btn btn-sm btn-pill btn-primary">Tambah Transaksi</a>
                    <a href="{{ url('/admin/simp_mutasi/import') }}" class="btn btn-sm btn-pill btn-info">Import Transaksi</a>  --}}
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tanggal</th>
                            <th>No. Transaksi</th>
                            <th>Nama Anggota</th>
                            <th>Nama Simpanan</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>                            
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($AgtTrx as $s)
                       <tr>
                        <td>
                            <div class="pull-right">
                                @if ($s->status=="Menunggu Konfirmasi")
                                    <a href="#modelhapus" onclick="$('#idhapus').val({{$s->id}})" data-toggle="modal" data-placement="top"  title="Hapus"><i class="fa fa-fw fa-trash" style="color:red"></i></a>

                                    <a href="{{ url('admin/simp_verifikasi/detail/'.$s->id) }}" data-toggle="tooltip" data-placement="top" title="Lihat Transaksi"><i class="fa fa-fw fa-info-circle"></i></a>
                                @else
                                <div class="badge badge-success"><i class="fa fa-fw fa-check"></i></div>
                                @endif     
                            </div>
                        </td>
                         <td>
                            {{ \Carbon\Carbon::parse($s->tanggal)->format('d-M-Y') }}
                         </td>
                         <td>
                          {{ $s->Anggota->no_anggota }}
                         </td>
                         <td>{{ $s->Anggota->nama_anggota }}</td>
                         <td>{{ $s->SimpRekening->SimpMaster->nama }}</td>                         
                         <td align="right">Rp. {{ number_format($s->nominal,2) }}</td>
                         <td>{{ $s->keterangan }}</td>
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
          <h5 class="modal-title" id="myModalLabel">Hapus Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah transaksi tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/simp_verifikasi/hapus')}}" method="POST">
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
