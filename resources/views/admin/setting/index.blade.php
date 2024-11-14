@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Aplikasi</h3>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-idkop-tab" data-toggle="tab" href="#nav-idkop" role="tab"
                                aria-controls="nav-idkop" aria-selected="true">Identitas Koperasi</a>
        
                            <a class="nav-item nav-link" id="nav-notif-tab" data-toggle="tab" href="#nav-notif"
                                role="tab" aria-controls="nav-notif" aria-selected="false">Notifikasi Email</a>
        
                            <a class="nav-item nav-link" id="nav-tagihan-tab" data-toggle="tab" href="#nav-tagihan"
                                role="tab" aria-controls="nav-tagihan" aria-selected="false">Periode Tagihan</a>
                            {{--  <a class="nav-item nav-link" id="nav-akunting-tab" data-toggle="tab" href="#nav-akunting" role="tab"
                                aria-controls="nav-akunting" aria-selected="false">Akunting</a>  --}}
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-idkop" role="tabpanel" aria-labelledby="nav-idkop-tab">
                            <form action="{{ url('admin/setting/update_perush') }}" method="post">
                                <div class="row">
                                    @if ($errors->any('nama_koperasi'))
                                        <div class="form-group has-error col-md-12">
                                    @else
                                        <div class="form-group col-md-12">
                                    @endif
                                        <label class="form-label">Nama Koperasi</label>
                                        <input type="text" name="nama_koperasi" class="form-control" value="{{ $NamaKop }}">
                                        <span class="help-block">{{ $errors->first('nama_koperasi') }}</span>
                                    </div>
                                </div>
        
                                <div class="row">
                                    @if ($errors->any('alamat'))
                                        <div class="form-group has-error col-md-12">
                                    @else
                                        <div class="form-group col-md-12">
                                    @endif
                                        <label class="form-label">Alamat Koperasi</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $Alamat }}">
                                        <span class="help-block">{{ $errors->first('alamat') }}</span>
                                    </div>
                                </div>
        
                                <div class="row">
                                    @if ($errors->any('cabang'))
                                        <div class="form-group has-error col-md-6">
                                    @else
                                        <div class="form-group col-md-6">
                                    @endif
                                        <label class="form-label">Cabang</label>
                                        <input type="text" name="cabang" class="form-control" value="{{ $Cabang }}">
                                        <span class="help-block">{{ $errors->first('cabang') }}</span>
                                    </div>
        
                                    @if ($errors->any('kota'))
                                        <div class="form-group has-error col-md-6">
                                    @else
                                        <div class="form-group col-md-6">
                                    @endif
                                        <label class="form-label">Cabang</label>
                                        <input type="text" name="kota" class="form-control" value="{{ $Kota }}">
                                        <span class="help-block">{{ $errors->first('kota') }}</span>
                                    </div>
                                </div>
        
                                <div class="row">
                                    @if ($errors->any('email'))
                                        <div class="form-group has-error col-md-6">
                                    @else
                                        <div class="form-group col-md-6">
                                    @endif
                                        <label class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" value="{{ $Email }}">
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    </div>
        
                                    @if ($errors->any('website'))
                                        <div class="form-group has-error col-md-6">
                                    @else
                                        <div class="form-group col-md-6">
                                    @endif
                                        <label class="form-label">Website</label>
                                        <input type="text" name="website" class="form-control" value="{{ $Website }}">
                                        <span class="help-block">{{ $errors->first('website') }}</span>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                          <div class="form-check">
                                              <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="is_stok" {{ $IsCheckStok }}> Aktifkan Sistem Stok
                                              </label>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                          </div>                                        
                                      </div>
                                </div>       
                            </form>
                        </div>

                        <div class="tab-pane fade show" id="nav-notif" role="tabpanel" aria-labelledby="nav-notif-tab">
                            <form action="{{ url('admin/setting/update_notif') }}" method="post">
                                <div class="row">
                                    @if ($errors->any('ketua'))
                                        <div class="form-group has-error col-md-12">
                                    @else
                                        <div class="form-group col-md-12">
                                    @endif
                                        <label class="form-label">Email Ketua</label>
                                        <input type="text" name="ketua" class="form-control" value="{{ $Ketua }}">
                                        <span class="help-block">{{ $errors->first('ketua') }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    @if ($errors->any('sekretaris'))
                                        <div class="form-group has-error col-md-12">
                                    @else
                                        <div class="form-group col-md-12">
                                    @endif
                                        <label class="form-label">Email Sekretaris</label>
                                        <input type="text" name="sekretaris" class="form-control" value="{{ $Sekretaris }}">
                                        <span class="help-block">{{ $errors->first('sekretaris') }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    @if ($errors->any('bendahara'))
                                        <div class="form-group has-error col-md-12">
                                    @else
                                        <div class="form-group col-md-12">
                                    @endif
                                        <label class="form-label">Email Bendahara</label>
                                        <input type="text" name="bendahara" class="form-control" value="{{ $Bendahara }}">
                                        <span class="help-block">{{ $errors->first('bendahara') }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    @if ($errors->any('jual_beli'))
                                        <div class="form-group has-error col-md-12">
                                    @else
                                        <div class="form-group col-md-12">
                                    @endif
                                        <label class="form-label">Email Unit Jual Beli</label>
                                        <input type="text" name="jual_beli" class="form-control" value="{{ $Ujb }}">
                                        <span class="help-block">{{ $errors->first('jual_beli') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                          <div class="form-check">
                                              <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="is_notif" {{ $IsCheckNotif }}> Kirim Notifikasi ke Email
                                              </label>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                          </div>
                                      </div>
                                </div>                                
                            </form>
                        </div>

                        <div class="tab-pane fade show" id="nav-tagihan" role="tabpanel" aria-labelledby="nav-tagihan-tab">
                            <form action="{{ url('admin/setting/update_periode') }}" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pengaturan Periode Tagihan</label>
                                        <input type="date" name="tgl_mulai" class="form-control"
                                            value="{{ $TglMulai }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <input type="date" name="tgl_selesai" class="form-control"
                                            value="{{ $TglSelesai }}">
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                      </div>
                                  </div>
                            </div>
                        </form>
                        </div>

                        <div class="tab-pane fade show" id="nav-akunting" role="tabpanel" aria-labelledby="nav-akunting-tab">
                            <form action="{{ url('admin/setting/update_aktsetting') }}" method="post">
                                <div class="col-lg-12">
                                    <div class="form-group col-lg-12">
                                        <label>Filter Perusahaan</label>
                                            <select class="js-example-basic-single w-100" name="idperush" id="single" autofocus>
                                                <option value="">-- Pilih Perusahaan -- </option>
                                            </select>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                          </div>
                                      </div>
                                </div>
                            
                            
                            </form>
                        </div>  
                        
                        

                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection
