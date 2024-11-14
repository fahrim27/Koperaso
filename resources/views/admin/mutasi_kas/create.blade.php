@extends('layouts.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Transaksi Kas</h3>
            </div>
            <div class="card-body">
                <div class="#">
                    <form action="{{url('admin/mutasi_kas/addnew')}}" method="post">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="jns_mutasi" id="kas_keluar" value="1"  data-description="Pengeluaran Kas Untuk" checked>
                                        Kas Keluar
                                      </label>
                                    </div>
                                  </div>
                                  <div class="col-sm-5">
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="jns_mutasi" id="kas_masuk" value="2" data-description="Pemasukan Kas Dari">
                                        Kas Masuk
                                      </label>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <br>
                        {{--  <div class="row">  --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="<?= date("Y-m-d"); ?>" >
                                  </div> 
                            </div>
                        {{--  </div>  --}}

                      @if ($errors->any('jenis'))
                          <div class="form-group has-error col-sm-12">
                      @else
                          <div class="form-group col-sm-12">
                      @endif
                        <label class="changename">Pengeluaran Kas Untuk</label>
                        <select class="js-example-basic-single w-100" name="kde_akun" id="single" autofocus>
                            <option value="">-- Pilih Akun --</option>
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
                        <span class="help-block">{{$errors->first('kde_akun')}}</span>
                      </div>

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

                      @if ($errors->any('keterangan'))
                          <div class="form-group has-error col-sm-12">
                      @else
                          <div class="form-group col-sm-12">
                      @endif
                          <label>Keterangan</label>
                          <input type="text" name="keterangan" class="form-control" value="{{Request::old('keterangan')}}">
                          <span class="help-block">{{$errors->first('keterangan')}}</span>
                      </div>
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
