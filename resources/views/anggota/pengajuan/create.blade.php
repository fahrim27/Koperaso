@extends('layouts_anggota.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Buat Pengajuan Pinjaman</h3>
                <blockquote class="blockquote">
                    <h4>{{ $NamaAgt }}</h4>
                    <h5>{{ $Perush }}</h5>
                </blockquote>  
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{url('anggota/pengajuan/addnew')}}" method="post"  enctype="multipart/form-data">
                        <input type="hidden" name="id_anggota" value="{{ $IdAnggota }}">
                        {{--  <input type="hidden" name="id_pinjaman" value="{{ $IdPinjaman }}">  --}}
                        <div class="row">                            
                                @if ($errors->any('pinjaman'))
                                    <div class="form-group input-group has-error col-md-12">
                                @else
                                    <div class="form-group input-group col-md-12">
                                @endif
                                <label>Jenis Pinjaman</label>
                                <select class="js-example-basic-single w-100" name="pinjaman" id="single2" autofocus>
                                    <option value="">-- Pilih Pinjaman --</option>
                                    @foreach ($PbyMaster as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{$errors->first('pinjaman')}}</span>
                                </div>
                        </div>
                        {{--  <div id="jasa"></div>  --}}
                        <input class="js-jasa" type="hidden" name="persen_jasa" value="" />

                        <div class="row">
                            <div class="col-md-6">
                                <label id="labelChanged">Nominal Pengajuan </label>
                                @if ($errors->any('jumlah'))
                                    <div class="form-group input-group has-error">
                                @else
                                    <div class="form-group input-group">
                                @endif
                                    <input type="text" min="0" name="jumlah" class="form-control" id="nominal" >
                                <span class="help-block">{{$errors->first('jumlah')}}</span>                                
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Jangka Waktu (Bulan) </label>
                                @if ($errors->any('jangka'))
                                    <div class="form-group input-group has-error">
                                @else
                                    <div class="form-group input-group">
                                @endif
                                    <input type="text" min="1" name="jangka" class="form-control" id="jangka" max="100" value="1">
                                <span class="help-block">{{$errors->first('jangka')}}</span>
                                </div>
                            </div>
                        </div>
                        <div id="show_sim">
                            {{--  <div id="simulasi"></div>   --}}
                        </div>
                        {{--  <blockquote id="simulasi" name="sim"></blockquote>  --}}
                        {{--  <span id="simulasi" class="text-danger"></span>  --}}
                        {{--  <span id="separator" class="text-danger"></span>  --}}

                        
                        <div class="row">
                            @if ($errors->any('keperluan'))
                                <div class="form-group has-error col-sm-12">
                            @else
                                <div class="form-group col-sm-12">
                            @endif
                                <label>Keperluan</label>
                                <input type="text" name="keperluan"class="form-control" >
                                <span class="help-block">{{$errors->first('keperluan')}}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            @if ($errors->any('filename'))
                                <div class="form-group has-error col-sm-12">
                            @else
                                <div class="form-group col-sm-12">
                            @endif
                                <label>Upload Tanda Tangan</label>
                                <br>
                                <img id="blah" src="{{ asset('public/images/noimage.png') }}" alt="tanda tangan"  width="250px" height="200px"/>
                                <input type="file" name="filename"  class="file-upload-default" onchange="readURL(this);">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                  </span>
                                </div>
                            </div>
                            {{--  <div class="form-group has-error col-sm-3">
                                
                            </div>     --}}
                        </div>

                        <div class="row">
                            @if ($errors->any('jenis'))
                                <div class="form-group has-error col-sm-12">
                            @else
                                <div class="form-group col-sm-12">
                            @endif
                                <label>Jaminan</label>
                                <select class="js-example-basic-single w-100" name="jaminan" id="single3" autofocus>
                                    <option value="">-- Pilih Jaminan --</option>
                                    <option value="Tanpa Jaminan">Tanpa Jaminan</option>
                                    <option value="BPKB">BPKB</option>
                                    <option value="Sertifikat">Sertifikat</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <span class="help-block">{{$errors->first('jaminan')}}</span>
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
                </form>               
            </div>
        </div>
    </div>
</div>
@endsection



