@extends('layouts_anggota.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Setoran Simpanan</h3>
            </div>
            <div class="card-body">
                    <form action="{{url('anggota/simpanan/setoran/addnew')}}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            @if ($errors->any('no_rekening'))
                                <div class="form-group has-error col-md-12">
                            @else
                                <div class="form-group col-md-12">
                            @endif
                            <label>Rekening Simpanan</label>
                            <select class="js-example-basic-single w-100" name="no_rekening" id="single" autofocus>
                                <option value="">-- Pilih Rekening --</option>
                                @foreach ($SimpRek as $k)
                                    <option value="{{ $k->id }}">
                                        {{ $k->no_rek }} - {{ $k->SimpMaster->nama }} - {{ $k->Anggota->nama_anggota }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('no_rekening')}}</span>
                            </div>
                        </div>
                        <div class="row">
                            @if ($errors->any('jumlah'))
                                <div class="form-group col-md-12 has-error">
                            @else
                                <div class="form-group col-md-12">
                            @endif
                                <label>Jumlah Setoran</label>
                                <input type="text" min="0" name="jumlah" class="form-control" id="nominal" >
                                <span class="help-block">{{$errors->first('jumlah')}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Upload Bukti Setoran</label>
                                    <input type="file" name="filename" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                      <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                      </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @if ($errors->any('keterangan'))
                                <div class="form-group has-error col-md-12">
                            @else
                                <div class="form-group col-md-12">
                            @endif
                                <label>Keterangan</label>
                                <input type="text" name="keterangan"class="form-control" >
                                <span class="help-block">{{$errors->first('keterangan')}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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
</div>
@endsection
