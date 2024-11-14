@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Level Jabatan</h3>
                <div class="card-options">
                    <a href="{{ url('/admin/ms_jabatan/addnew') }}" class="btn btn-sm btn-pill btn-primary">Tambah Jabatan</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Level Jabatan</th>
                            <th>Simpanan Pokok</th>
                            <th>Simpanan Wajib</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Jabatan as $Jbt)
                        <tr>
                            <td>
                                {{ $Jbt->nama }}
                            </td>
                            <td align="right">
                              {{ number_format($Jbt->simp_pokok,2) }}
                            </td>
                            <td align="right">
                              {{ number_format($Jbt->simp_wajib,2) }}
                            </td>
                            <td>
                                <div class="pull-right">
                                  <a href="{{ url('admin/ms_jabatan/edit/'.$Jbt->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa fa-fw fa-edit"></i></a>
                                     <a href="#modelhapus" onclick="$('#idhapus').val({{$Jbt->id}})" data-toggle="modal" data-placement="top"  title="Hapus">
                                       <i class="fa fa-fw fa-trash"></i></a>
                                </div>
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
          <h5 class="modal-title" id="myModalLabel">Hapus Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah jabatan tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/ms_jabatan/hapus')}}" method="POST">
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
