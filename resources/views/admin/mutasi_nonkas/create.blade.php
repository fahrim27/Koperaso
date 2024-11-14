@extends('layouts.app')
@section('content-app')
@include('message.flash')

<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Memorial</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{url('admin/memorial/addnew')}}" method="post">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="jns_mutasi" id="db_kredit" value="1" checked>
                                            Debet - Kredit
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-sm-5">
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="jns_mutasi" id="kr_debet" value="2">
                                            Kredit - Debet
                                          </label>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="<?= date("Y-m-d"); ?>" >
                                  </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No. Transaksi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">{{ $PrefixNo }}</span>
                                        </div>
                                        <input type="text" class="form-control" name="no_transaksi" value="{{ Request::old('no_transaksi') == null ? $MaxNo : Request::old('no_transaksi') }}">
                                      </div>

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
                            <div class="col-md-6">
                                @if ($errors->any('jenis'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                <label id="lbl_db"> Akun Debet </label>
                                <select class="js-example-basic-single w-100" name="akun_debet" id="single" autofocus>
                                    <option value="">-- Pilih Akun --</option>
                                    @foreach ($Akun as $k)
                                        <option value="{{ $k->kde_akun }}" {{ Request::old('akun_debet') == $k->kde_akun ? 'selected' : ''}}>
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
                            <div class="col-md-6">
                                <label>Nominal </label>
                                @if ($errors->any('jumlah'))
                                   <div class="form-group input-group has-error">
                                @else
                                   <div class="form-group input-group">
                                @endif
                                    <input type="text" min="0" name="jumlah" class="form-control" id="nominal" value="{{ Request::old('jumlah') }}">
                                   <span class="help-block">{{$errors->first('jumlah')}}</span>
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
                                <label id="lbl_kr">Akun Kredit</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-md-8">
                                @if ($errors->any('jenis'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                <select class="js-example-basic-single w-100" name="akun_kredit" id="single2" autofocus>
                                    <option value="">-- Pilih Akun --</option>
                                    @foreach ($Akun as $k)
                                        <option value="{{ $k->kde_akun }}" {{ Request::old('akun_kredit') == $k->kde_akun ? 'selected' : ''}}>
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
                        
                            <div class="col-md-4">
                                @if ($errors->any('jumlah_kredit'))
                                   <div class="form-group input-group has-error">
                                @else
                                   <div class="form-group input-group">
                                @endif
                                    <input type="text" min="0" name="jumlah_kredit" class="form-control" id="nominal2" >
                                   <span class="help-block">{{$errors->first('jumlah')}}</span> &nbsp;
                                   <button type="submit" name="btnType" value="btnAddDetail" class="btn btn-primary"><i class="fa fa-plus"></i> </button>
                                </div>
                            </div>
                        </div>
                            <div class="row"> 
                                @if ($AktDetail == null)
                                    
                                @else 
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <thead>
                                                <tr class="bg-dark text-white">
                                                    <th width="80%">Nama Akun</th>
                                                    <th class="text-right">Nominal</th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody>                
                                                @foreach ($AktDetail as $i)
                                                @php
                                                $Kode = $i['akun_kredit'];
                                                @endphp
                                                    <tr class="text-right">
                                                        <td class="text-left">
                                                            {{ $i['akun_kredit'] }}   -  {{ $i['nama_akun'] }}
                                                        </td>
                                                        <td>Rp {{ number_format($i['jumlah_kredit']) }}</td>
                                                        <td>
                                                            <div class="pull-right">
                                                                <input type="hidden" name="kode" value="{{ $Kode }}">
                                                                <button type="submit" name="btnType" value="btnHapus" class="btn btn-transparent"><i class="fa fa-trash text-danger"></i> </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-right">
                                                        <h3><strong>Total &nbsp;&nbsp;&nbsp; Rp {{ number_format($subtotal) }}</strong>
                                                        </h3>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @endif      
                            </div>
                        </div>        

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" name="btnType" value="btnPost" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                  </div>
                              </div>
                        </div>
                    </form>
            </div>
        </div>
</div>
<div class="modal fade" id="modelhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Hapus Detail Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah akun tersebut akan dihapus dari transaksi ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/memorial/hapus_detail')}}" method="POST">
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
