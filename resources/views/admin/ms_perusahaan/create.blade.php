@extends('layouts.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Perusahaan</h3>
                
            </div>
            <div class="card-body">
                <form action="{{ url('admin/ms_perusahaan/addnew') }}" method="post">
                    <div class="row">
                        @if ($errors->any('inisial'))
                            <div class="form-group has-error col-md-6">
                        @else
                            <div class="form-group col-md-6">
                        @endif
                            <label class="form-label">Inisial Perusahaan</label>
                            <input type="text" name="inisial" class="form-control" value="">
                            <span class="help-block">{{ $errors->first('inisial') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        @if ($errors->any('nama'))
                            <div class="form-group has-error col-md-12">
                        @else
                            <div class="form-group col-md-12">
                        @endif
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama" class="form-control" value="">
                            <span class="help-block">{{ $errors->first('nama') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pull-right">
                                <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
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
