@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Profil</h3>               
            </div>
            <div class="card-body">
              <form action="{{ url('admin/edit_profil/update') }}" method="post">
                <div class="row">
                  @if ($errors->any('nama'))
                      <div class="form-group has-error col-md-12">
                  @else
                      <div class="form-group col-md-12">
                  @endif
                      <label class="form-label">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" value="{{ $User->name }}">
                      <span class="help-block">{{ $errors->first('nama') }}</span>
                  </div> 
                </div>
                <div class="row">
                  @if ($errors->any('email'))
                      <div class="form-group has-error col-md-12">
                  @else
                      <div class="form-group col-md-12">
                  @endif
                      <label class="form-label">Email</label>
                      <input type="text" name="email" class="form-control" value="{{ $User->email }}">
                      <span class="help-block">{{ $errors->first('email') }}</span>
                  </div> 
                </div>

                <div class="row">
                  @if ($errors->any('password'))
                      <div class="form-group has-error col-md-12">
                  @else
                      <div class="form-group col-md-12">
                  @endif
                      <label class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" value="">
                      <span class="help-block">{{ $errors->first('password') }}</span>
                  </div> 
                </div>

                <div class="row">
                  <div class="col-md-12">
                      <div class="pull-right">
                          <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <input type="hidden" name="id" value={{ $User->id }}>
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
