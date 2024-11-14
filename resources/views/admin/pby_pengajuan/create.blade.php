@extends('layouts.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Buat Pengajuan Pinjaman</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{url('admin/pengajuan/addnew')}}" method="post">
                        <div class="row">
                            @if ($errors->any('id_anggota'))
                                <div class="form-group has-error col-md-12">
                            @else
                                <div class="form-group col-md-12">
                            @endif
                            <label>Nama Anggota</label>
                            <select class="js-example-basic-single w-100" name="id_anggota" id="single" autofocus>
                                <option value="">-- Pilih Anggota --</option>
                                @foreach ($Anggota as $k)
                                    <option value="{{ $k->id }}">
                                        {{ $k->no_anggota }} - {{ $k->nama_anggota }} - {{ $k->Perusahaan->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('id_anggota')}}</span>
                            </div>
                        </div>

                        <div class="row">
                            @if ($errors->any('id_pinjaman'))
                                <div class="form-group has-error col-md-12">
                            @else
                                <div class="form-group col-md-12">
                            @endif
                            <label>Produk Pinjaman</label>
                            <select class="js-example-basic-single w-100" name="id_pinjaman" id="single2" autofocus>
                                <option value="">-- Pilih Produk Pinjaman --</option>
                                @foreach ($PbyMaster as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('id_pinjaman')}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Nominal Pengajuan </label>
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
                                    <input type="number" min="0" name="jangka" class="form-control" id="nominal" >
                                <span class="help-block">{{$errors->first('jangka')}}</span>
                                </div>
                            </div>
                        </div>
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
                            @if ($errors->any('jenis'))
                                <div class="form-group has-error col-sm-6">
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
            </div>
        </div>
    </div>
</div>
@endsection
