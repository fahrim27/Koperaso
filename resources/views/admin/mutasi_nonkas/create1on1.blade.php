@extends('layouts.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Transaksi Memorial</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{url('admin/memorial/addnew')}}" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="<?= date("Y-m-d"); ?>" >
                                  </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any('jenis'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                <label class="changename">Akun Debet</label>
                                <select class="js-example-basic-single w-100" name="akun_debet" id="single" autofocus>
                                    <option value="">-- Pilih Akun Debet--</option>
                                    @foreach ($Akun as $k)
                                        <option value="{{ $k->kde_akun }}">
                                            @if ($k->pos_akun == 1)
                                                <b>{{ $k->nma_akun }}</b>
                                            @else
                                                &nbsp;&nbsp;{{ $k->nma_akun }}
                                            @endif

                                        </option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{$errors->first('akun_debet')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any('jenis'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                <label class="changename">Akun Kredit</label>
                                <select class="js-example-basic-single w-100" name="akun_kredit" id="single2" >
                                    <option value="">-- Pilih Akun Kredit--</option>
                                    @foreach ($Akun as $k)
                                        <option value="{{ $k->kde_akun }}">
                                            @if ($k->pos_akun == 1)
                                                <b>{{ $k->nma_akun }}</b>
                                            @else
                                                &nbsp;&nbsp;{{ $k->nma_akun }}
                                            @endif

                                        </option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{$errors->first('akun_kredit')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nominal </label>
                                @if ($errors->any('jumlah'))
                                   <div class="form-group input-group has-error">
                                @else
                                   <div class="form-group input-group">
                                @endif
                                    <input type="text" min="0" name="jumlah" class="form-control" id="nominal" >
                                   <span class="help-block">{{$errors->first('jumlah')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any('keterangan'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" value="{{Request::old('keterangan')}}">
                                    <span class="help-block">{{$errors->first('keterangan')}}</span>
                                </div>                        
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
            </div>
        </div>
    </>
</div>
@endsection
