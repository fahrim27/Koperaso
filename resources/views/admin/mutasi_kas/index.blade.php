@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Kas</h3>
                <div class="card-options">
                    <a href="{{ url('/admin/mutasi_kas/addnew') }}" class="btn btn-sm btn-pill btn-primary">Tambah Transaksi</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No Transaksi</th>
                            {{-- <th>Kode Akun</th> --}}
                            <th>Nama Akun</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($KasMutasi as $Akt)
                        <tr>
                            <td>
                                {{ $Akt->tanggal }}
                            </td>
                            <td>
                                {{ $Akt->no_bukti }}
                            </td>
                            {{-- <td>
                                {{ $Akt->kde_akun }}
                            </td> --}}
                            <td>
                                @if ($Akt->pos_akun == 1)
                                    {{ $Akt->nma_akun }}
                                @else
                                    &nbsp;&nbsp;{{ $Akt->nma_akun }}
                                @endif
                            </td>
                            <td>
                                {{ $Akt->keterangan }}
                            </td>
                            <td align="right">
                                {{ number_format($Akt->debet,2) }}
                            </td>
                            <td align="right">
                                {{ number_format($Akt->kredit,2) }}
                            </td>
                            <td>
                                <div class="pull-right">                         
                                    <a href="#modelhapus" onclick="$('#idhapus').val({{$Akt->id}})" data-toggle="modal" data-placement="top"  title="Hapus Akun">
                                        <i class="fa fa-fw fa-trash text-danger"></i></a></div>
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
          <h5 class="modal-title" id="myModalLabel">Hapus Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah transaksi tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/mutasi_kas/hapus')}}" method="POST">
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
