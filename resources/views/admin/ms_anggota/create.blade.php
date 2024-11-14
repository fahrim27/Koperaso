@extends('layouts.app')
@section('content-app')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Anggota</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/master_anggota/addnew')}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            @if ($errors->any('nik'))
                                <div class="form-group has-error col-md-6">
                            @else
                                <div class="form-group col-md-6">
                            @endif
                                <label class="form-label">NIK (Karyawan)</label>
                                <input type="text" name="nik" class="form-control" value="" autofocus>
                                <span class="help-block">{{ $errors->first('nik') }}</span>
                            </div>

                            @if ($errors->any('nama'))
                                <div class="form-group has-error col-md-6">
                            @else
                                <div class="form-group col-md-6">
                            @endif
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="">
                                <span class="help-block">{{ $errors->first('nama') }}</span>
                            </div>                            
                        </div>

                        <div class="row">
                            @if ($errors->any('email'))
                                <div class="form-group has-error col-md-6">
                            @else
                                <div class="form-group col-md-6">
                            @endif
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="">
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>

                            @if ($errors->any('password'))
                                <div class="form-group has-error col-md-6">
                            @else
                                <div class="form-group col-md-6">
                            @endif
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="">
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            </div>
                        </div>

                        <div class="row">
                            
                            @if ($errors->any('jenkel'))
                                <div class="form-group has-error col-md-4">
                            @else
                                <div class="form-group col-md-4">
                            @endif
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="jenkel"
                                            value="Laki-laki">
                                        <span class="custom-control-label">Laki-laki</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="jenkel" value="Perempuan"
                                            checked="">
                                        <span class="custom-control-label">Perempuan</span>
                                    </label>
                                </div>
                                <span class="help-block">{{ $errors->first('jenkel') }}</span>
                            </div>


                            @if ($errors->any('tempat_lahir'))
                                <div class="form-group has-error col-md-4">
                            @else
                                <div class="form-group col-md-4">
                            @endif                                
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="">
                                <span class="help-block">{{ $errors->first('tempat_lahir') }}</span>
                            </div>

                            @if ($errors->any('tgl_lahir'))
                                <div class="form-group has-error col-md-4">
                            @else
                                <div class="form-group col-md-4">
                            @endif   
                                <label class="form-label">Tgl Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" value="">
                                <span class="help-block">{{ $errors->first('tgl_lahir') }}</span>
                            </div>
                        </div>                        
                        
                        <div class="row">
                            @if ($errors->any('perusahaan'))
                                <div class="form-group has-error col-md-4">
                            @else
                                <div class="form-group col-md-4">
                            @endif
                            <label>Perusahaan</label>
                            <select class="js-example-basic-single w-100" name="perusahaan" id="single" autofocus>
                                <option value="">-- Pilih Perusahaan --</option>
                                @foreach ($Perush as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('perusahaan') }}</span>
                        </div>

                        @if ($errors->any('department'))
                            <div class="form-group has-error col-md-4">
                        @else
                            <div class="form-group col-md-4">
                        @endif
                            <label>Department</label>
                            <select class="js-example-basic-single w-100" name="department" id="single2" autofocus>
                                <option value="">-- Pilih Department --</option>
                                @foreach ($Department as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('department') }}</span>
                        </div>

                        @if ($errors->any('sts_karyawan'))
                            <div class="form-group has-error col-md-4">
                        @else
                            <div class="form-group col-md-4">
                        @endif
                            <label>Status Karyawan</label>
                            <select class="js-example-basic-single w-100" name="sts_karyawan" id="single3" autofocus>
                                <option value="">-- Pilih Status Karyawan --</option>                                
                                <option value="Permanen">Permanen</option>
                                <option value="Kontrak">Kontrak</option>
                                <option value="Probation">Probation</option>
                            </select>
                            <span class="help-block">{{ $errors->first('sts_karyawan') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        @if ($errors->any('ktp'))
                            <div class="form-group has-error col-md-4">
                        @else
                            <div class="form-group col-md-4">
                        @endif
                            <label class="form-label">No. KTP</label>
                            <input type="text" name="ktp" class="form-control" value="">
                            <span class="help-block">{{ $errors->first('ktp') }}</span>
                        </div>
                        
                        @if ($errors->any('telpon'))
                            <div class="form-group has-error col-md-4">
                        @else
                            <div class="form-group col-md-4">
                        @endif
                            <label class="form-label">No. Telpon</label>
                            <input type="text" name="telpon" class="form-control" value="">
                            <span class="help-block">{{ $errors->first('telpon') }}</span>
                        </div>

                        @if ($errors->any('kontak_darurat'))
                            <div class="form-group has-error col-md-4">
                        @else
                            <div class="form-group col-md-4">
                        @endif
                            <label class="form-label">No. Telpon (Orang tua/Suami/Istri/Saudara)</label>
                            <input type="text" name="kontak_darurat" class="form-control" value="">
                            <span class="help-block">{{ $errors->first('kontak_darurat') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        @if ($errors->any('alamat'))
                            <div class="form-group has-error col-md-12">
                        @else
                            <div class="form-group col-md-12">
                        @endif

                            <label class="form-label">Alamat Sesuai KTP</label>
                            <textarea rows="2" class="form-control" name="alamat"></textarea>
                            <span class="help-block">{{ $errors->first('alamat') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        @if ($errors->any('domisili'))
                            <div class="form-group has-error col-md-12">
                        @else
                            <div class="form-group col-md-12">
                        @endif

                            <label class="form-label">Alamat Domisili</label>
                            <textarea rows="2" class="form-control" name="domisili"></textarea>
                            <span class="help-block">{{ $errors->first('domisili') }}</span>
                        </div>
                    </div>
                    
                    <div class="row">
                        @if ($errors->any('rek_bank'))
                            <div class="form-group has-error col-md-6">
                        @else
                            <div class="form-group col-md-6">
                        @endif
                            <label class="form-label">No. Rekening Bank</label>
                            <input type="text" name="rek_bank" class="form-control" value="">
                            <span class="help-block">{{ $errors->first('telpon') }}</span>
                        </div>
                        
                        @if ($errors->any('jabatan'))
                            <div class="form-group has-error col-md-6">
                        @else
                            <div class="form-group col-md-6">
                        @endif
                            <label>Jabatan</label>
                            <select class="js-example-basic-single w-100" name="jabatan" id="single4" autofocus>
                                <option value="">-- Pilih Jabatan --</option>                                
                                @foreach ($Jabatan as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama }} - Rp. {{ number_format($j->simp_wajib,2) }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('jabatan') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Upload Foto KTP</label>
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
                        <div class="col-sm-12">
                            <div class="pull-right">
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
@endsection
