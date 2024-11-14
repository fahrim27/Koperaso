@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengaturan Akunting</h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/master_akun/update_aktsetting')}}" method="post">
                    <div class="row">
                        <div class="form-group col-md-6">                    
                            <label>Akun Kas</label>
                            <select class="js-example-basic-single w-100" name="akun_kas" id="single" autofocus>
                            <option value="">-- Pilih Akun --</option>
                            @foreach ($Akun as $k)
                                <option value="{{ $k->kde_akun }}" {{ $k->kde_akun == $AkunKas ? "selected" : "" }}>
                                    @if ($k->pos_akun == 1)
                                        <b>{{ $k->nma_akun }}</b>
                                    @else
                                        &nbsp;&nbsp;{{ $k->nma_akun }}
                                    @endif
    
                                </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">                    
                            <label >Akun Persediaan</label>
                            <select class="js-example-basic-single w-100" name="akun_persediaan" id="single1">
                            <option value="">-- Pilih Akun --</option>
                            @foreach ($Akun as $k)
                                <option value="{{ $k->kde_akun }}" {{ $k->kde_akun == $AkunPersediaan ? "selected" : "" }}>
                                    @if ($k->pos_akun == 1)
                                        <b>{{ $k->nma_akun }}</b>
                                    @else
                                        &nbsp;&nbsp;{{ $k->nma_akun }}
                                    @endif

                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">                    
                            <label >Akun SHU Tahun Berjalan</label>
                            <select class="js-example-basic-single w-100" name="akun_shuthnberjalan" id="single2">
                            <option value="">-- Pilih Akun --</option>
                            @foreach ($Akun as $k)
                                <option value="{{ $k->kde_akun }}" {{ $k->kde_akun == $AkunShuThnBerjalan ? "selected" : "" }}>
                                    @if ($k->pos_akun == 1)
                                        <b>{{ $k->nma_akun }}</b>
                                    @else
                                        &nbsp;&nbsp;{{ $k->nma_akun }}
                                    @endif
    
                                </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">                    
                            <label >Akun SHU Tahun Lalu</label>
                            <select class="js-example-basic-single w-100" name="akun_shuthnlalu" id="single3" >
                            <option value="">-- Pilih Akun --</option>
                            @foreach ($Akun as $k)
                                <option value="{{ $k->kde_akun }}" {{ $k->kde_akun == $AkunShuThnLalu ? "selected" : "" }}>
                                    @if ($k->pos_akun == 1)
                                        <b>{{ $k->nma_akun }}</b>
                                    @else
                                        &nbsp;&nbsp;{{ $k->nma_akun }}
                                    @endif

                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    
                
                    <div class="col-sm-12">
                        <div class="float-right">
                            <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
