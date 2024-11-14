@extends('layouts.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Akun</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{url('admin/master_akun/add_akun')}}" method="post">
                      @if ($errors->any('jenis'))
                          <div class="form-group has-error col-sm-6">
                      @else
                          <div class="form-group col-sm-12">
                      @endif
                        <label>Jenis Akun</label>
                        <select class="js-example-basic-single w-100" name="jenis" id="single" autofocus>
                            <option value="">-- Pilih Jenis Akun --</option>
                            <option value="1">Aktiva</option>
                            <option value="2">Pasiva</option>
                            {{-- <option value="3">Modal</option> --}}
                            <option value="4">Pendapatan</option>
                            <option value="5">Biaya</option>
                        </select>
                        <span class="help-block">{{$errors->first('jenis')}}</span>
                      </div>
                      
                      @if ($errors->any('nama'))
                          <div class="form-group has-error col-sm-12">
                      @else
                          <div class="form-group col-sm-12">
                      @endif
                          <label>Nama Akun</label>
                          <input type="text" name="nama" class="form-control" value="{{Request::old('nama')}}">
                          <span class="help-block">{{$errors->first('nama')}}</span>
                      </div>

                      {{-- <div class="col-sm-12">
                        <label>Saldo Awal</label>
                        @if ($errors->any('saldo_awal'))
                           <div class="form-group input-group has-error">
                        @else
                           <div class="form-group input-group">
                        @endif
                            <input type="text" min="0" name="saldo_awal" class="form-control" id="nominal" value="0">
                           <span class="help-block">{{$errors->first('saldo_awal')}}</span>
                        </div>
                      </div> --}}
                  </div>
                  <div class="col-sm-12">
                    <div class="pull-right">
                        <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                  </div>

            </div>
        </div>
    </div>
</div>
@endsection
