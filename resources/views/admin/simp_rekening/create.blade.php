@extends('layouts.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Buat Rekening Simpanan</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{url('admin/simp_rekening/addnew')}}" method="post">
                        <div class="row">
                            @if ($errors->any('id_anggota'))
                                <div class="form-group has-error col-md-10">
                            @else
                                <div class="form-group col-md-10">
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
                            @if ($errors->any('id_simpanan'))
                                <div class="form-group has-error col-md-10">
                            @else
                                <div class="form-group col-md-10">
                            @endif
                            <label>Produk Simpanan</label>
                            <select class="js-example-basic-single w-100" name="id_simpanan" id="single2" autofocus>
                                <option value="">-- Pilih Produk Simpanan --</option>
                                @foreach ($SimpMaster as $s)
                                    <option value="{{ $s->kode }}">{{ $s->nama }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('id_simpanan')}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
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
