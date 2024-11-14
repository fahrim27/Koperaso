@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Akun (CoA)</h3>
                <div class="card-options">
                    <a href="{{ url('/admin/master_akun/add_akun') }}" class="btn btn-sm btn-pill btn-primary">Tambah Akun</a>
                    <a href="{{ url('/admin/master_akun/setting_akun') }}" class="btn btn-sm btn-pill btn-primary"><i class="fa fa-gears"></i>  Pengaturan Akunting</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data#" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Akun</th>
                            <th>Jenis Akun</th>
                            <th>Nama Akun</th>
                            {{-- <th>Saldo Akun</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Akun as $Akt)
                        <tr>
                            <td>
                                @if ($Akt->pos_akun == 1)
                                    <b>{{ $Akt->kde_akun }}</b>
                                @else
                                    {{ $Akt->kde_akun }}
                                @endif
                            </td>
                            <td>
                                @if ($Akt->pos_akun == 1)
                                    <b>{{ $Akt->jenis }}</b>
                                @else
                                    {{ $Akt->jenis }}
                                @endif
                            </td>
                            <td>
                                @if ($Akt->pos_akun == 1)
                                    <b>{{ $Akt->nma_akun }}</b>
                                @else
                                    &nbsp&nbsp{{ $Akt->nma_akun }}
                                @endif
                            </td>
                            {{-- <td>
                                @if ($Akt->pos_akun == 1)
                                    <b>{{ number_format($Akt->saldo_akhir,2) }}</b>
                                @else
                                    {{ number_format($Akt->saldo_akhir,2) }}
                                @endif
                            </td> --}}
                            <td>
                                <div class="pull-right">
                                  @if ($Akt->pos_akun == 1)
                                     <a href="{{ url('admin/master_akun/add_subakun/'.$Akt->id) }}" data-toggle="tooltip" data-placement="top" title="Tambah Sub Akun">
                                       <i class="fa fa-fw fa-sitemap"></i></a>
                                     <a href="{{ url('admin/master_akun/edit_akun/'.$Akt->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Akun">
                                       <i class="fa fa-fw fa-edit fa-danger"></i></a>
                                     <a href="#modelhapus" onclick="$('#idhapus').val({{$Akt->id}})" data-toggle="modal" data-placement="top"  title="Hapus Akun">
                                       <i class="fa fa-fw fa-trash"></i></a>
                                  @else
                                    <a href="{{ url('admin/master_akun/edit_subakun/'.$Akt->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Sub Akun">
                                      <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#modelhapus" onclick="$('#idhapus').val({{$Akt->id}})" data-toggle="modal" data-placement="top" title="Hapus Sub Akun">
                                      <i class="fa fa-fw fa-trash"></i></a>
                                  @endif
                                </div>
                              </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                {{ $Akun->links() }}
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
