@extends('layouts.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Sub Akun</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/master_akun/update_subakun') }}" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->any('jenis'))
                                <div class="form-group has-error col-sm-12">
                            @else
                                <div class="form-group col-sm-12">
                            @endif
                                <label>Jenis Akun</label>
                                <select class="form-control" disabled>
                                    <option value="{{ $Akun->jenis }}" selected>{{ $Akun->jenis }}</option>
                                </select>
                                <span class="help-block">{{ $errors->first('jenis') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if ($errors->any('nama'))
                                <div class="form-group has-error col-sm-12">
                            @else
                                <div class="form-group col-sm-12">
                            @endif
                                <label>Nama Akun</label>
                                <input type="text" name="nama" disabled class="form-control" value="{{ $Akun->nma_akun }}">
                                <span class="help-block">{{ $errors->first('nama') }}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @if ($errors->any('namasub'))
                                <div class="form-group has-error col-sm-12">
                            @else
                                <div class="form-group col-sm-12">
                            @endif
                                <label>Nama Sub Akun</label>
                                <input type="text" name="namasub" class="form-control" value="{{ ltrim($MsAkun->nma_akun) }}">
                                <span class="help-block">{{$errors->first('namasub')}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{ $MsAkun->id }}">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
