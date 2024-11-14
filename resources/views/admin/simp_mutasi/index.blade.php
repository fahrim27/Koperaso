@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Simpanan</h3>
                <div class="card-options">
                    <a href="{{ url('/admin/simp_mutasi/addnew') }}" class="btn btn-sm btn-pill btn-primary">Tambah Transaksi</a>
                    <a href="{{ url('/admin/simp_mutasi/import') }}" class="btn btn-sm btn-pill btn-info">Import Transaksi</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tanggal</th>
                            <th>No. Transaksi</th>
                            <th>Nama Anggota</th>
                            <th>Nama Simpanan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Keterangan</th>                            
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($SimpMutasi as $s)
                       <tr>
                        <td>
                          <div class="pull-right">
                            <a href="" onclick="window.open('{{ url('/admin/simp_mutasi/cetak_bukti/'.$s->id) }}', '_blank', 'directories=no, toolbar=0,location=0,menubar=0,resizable=yes,width=750');" title="Cetak">
                              <i class="fa fa-fw fa-print"></i></a>                         
                            <a href="#modelhapus" onclick="$('#idhapus').val({{$s->id}})" data-toggle="modal" data-placement="top"  title="Hapus">
                                <i class="fa fa-fw fa-trash" style="color:red"></i></a>
                          </div>
                        </td>
                         <td>
                          {{ \Carbon\Carbon::parse($s->tanggal)->format('d-m-Y') }}
                         </td>
                         <td>
                          {{ $s->no_bukti }}
                         </td>
                         <td>{{ $s->nama_anggota }}</td>
                         <td>{{ $s->nama }}</td>                         
                         <td align="right">{{ number_format($s->debet,2) }}</td>
                         <td align="right">{{ number_format($s->kredit,2) }}</td>
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
          <form action="{{url('admin/simp_mutasi/delete')}}" method="POST">
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
