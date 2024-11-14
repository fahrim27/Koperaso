<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <title>Registrasi Anggota Koperasi</title>
    <link rel="shortcut icon" href="{{ asset('public/admin/template') }}/images/logokop.png" />

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/template') }}/js/select.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/css/vertical-layout-light/style.css">

    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        jQuery(function ($) {
            $('#my-form').validate({
                rules: {},
                messages: {},
                submitHandler: function () {
                    return false
                }
            });
            $('input[name^="fileupload"]').rules('add', {
                required: true,
                accept: "image/jpeg, image/pjpeg"
            })
        })
    </script>
</head>
<body>
    <div class="page">
        <div class="page-single">
            <div class="container">
                @include('message.flash')
                <div class="row">
                    <div class="col mx-auto">
                        <div class="card">
                            <div class="text-center my-5">
                               <a href="{{ url('/') }}"><img src="{{ asset('public/admin/template') }}/images/logokop.png"
                                alt="logo" width="300"></a>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">Koperasi Paragon Untung Bareng 
                                </h3>
                                <div class="card-option">
                                    <p>
                                        Hi, 
Terima kasih atas ketertarikannya menjadi anggota Koperasi Karyawan Paragon Untung Bareng

Kami informasikan kembali bahwa syarat menjadi anggota koperasi yaitu menyetorkan uang sebagai simpanan pokok dan simpanan wajib dengan ketentuan sebagai berikut 
                                    </p><br>
                                    <h5>Simpanan Pokok</h5>
                                    <p>
                                        Rp. 100.000 
                                        (dibayarkan 1x saat awal menjadi anggota dan bisa diambil jika sudah tidak menjadi anggota)
                                    </p>
<br>
                                    <h5>
                                        Simpanan Wajib 
                                    </h5>
                                    <ul>
                                        <li>Non Staff Rp 50.000,- </li>
                                        <li>Staff - Sr. Staff Rp 150.000,- </li>
                                        <li>Manager - Sr. Manager Rp. 250.000,- </li>
                                        <li>Director  Rp 500.000,- </li>                                        
                                        <p>(dibayarkan setiap bulan dan bisa diambil dalam bentuk pinjaman atau ketika sudah tidak menjadi anggota)</p>
                                    </ul>
                                    

                                </div>
                                {{--  <div class="card-options">
                                    <a href="{{ url('/') }}" class="btn btn-sm btn-pill btn-secondary">Kembali</a>
                                </div>  --}}
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/registrasi_anggota') }}" method="POST" enctype="multipart/form-data" id="my-form">
                                    <div class="row">
                                        {{--  @if ($errors->any('nik'))
                                            <div class="form-group has-error col-md-6">
                                        @else
                                            <div class="form-group col-md-6">
                                        @endif
                                            <label class="form-label">NIK (Karyawan)</label>
                                            <input type="text" name="nik" class="form-control" value="">
                                            <span class="help-block">{{ $errors->first('nik') }}</span>
                                        </div>  --}}
            
                                        @if ($errors->any('nama'))
                                            <div class="form-group has-error col-md-12">
                                        @else
                                            <div class="form-group col-md-12">
                                        @endif
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" value="{{Request::old('nama')}}">
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
                                            <input type="email" name="email" class="form-control" value="{{Request::old('email')}}">
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        </div>
            
                                        @if ($errors->any('password'))
                                            <div class="form-group has-error col-md-6">
                                        @else
                                            <div class="form-group col-md-6">
                                        @endif
                                            <label class="form-label">Kata Sandi <small class="text-danger">Min. 6 karakter</small></label>
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
                                            <input type="text" name="tempat_lahir" class="form-control" value="{{Request::old('tempat_lahir')}}">
                                            <span class="help-block">{{ $errors->first('tempat_lahir') }}</span>
                                        </div>
            
                                        @if ($errors->any('tgl_lahir'))
                                            <div class="form-group has-error col-md-4">
                                        @else
                                            <div class="form-group col-md-4">
                                        @endif   
                                            <label class="form-label">Tgl Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control" value="{{ Request::old('tgl_lahir', date('Y-m-d')) }}">
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
                                        <select class="js-example-basic-single w-100" name="perusahaan" id="single">
                                            <option value="">-- Pilih Perusahaan --</option>
                                            @foreach ($Perush as $p)
                                                <option value="{{ $p->id }}" {{ Request::old('perusahaan') == $p->id ? "selected" : "" }}>{{ $p->nama }}</option>
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
                                        <select class="js-example-basic-single w-100" name="department" id="single2">
                                            <option value="">-- Pilih Department --</option>
                                            @foreach ($Department as $d)
                                                <option value="{{ $d->id }}" {{ Request::old('department') == $d->id ? "selected" : "" }}>{{ $d->nama }}</option>
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
                                        <select class="js-example-basic-single w-100" name="sts_karyawan" id="single3">
                                            <option value="">-- Pilih Status Karyawan --</option>                                
                                            <option value="Permanen" {{ Request::old('sts_karyawan') == "Permanen" ? "selected" : "" }}>Permanen</option>
                                            <option value="Kontrak" {{ Request::old('sts_karyawan') == "Kontrak" ? "selected" : "" }}>Kontrak</option>
                                            <option value="Probation" {{ Request::old('sts_karyawan') == "Probation" ? "selected" : "" }}>Probation</option>
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
                                        <input type="text" name="ktp" class="form-control" value="{{ Request::old('ktp') }}">
                                        <span class="help-block">{{ $errors->first('ktp') }}</span>
                                    </div>
                                    
                                    @if ($errors->any('telpon'))
                                        <div class="form-group has-error col-md-4">
                                    @else
                                        <div class="form-group col-md-4">
                                    @endif
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" name="telpon" class="form-control" value="{{ Request::old('telpon') }}">
                                        <span class="help-block">{{ $errors->first('telpon') }}</span>
                                    </div>
            
                                    @if ($errors->any('kontak_darurat'))
                                        <div class="form-group has-error col-md-4">
                                    @else
                                        <div class="form-group col-md-4">
                                    @endif
                                        <label class="form-label">No. Telepon (Orang tua/Suami/Istri/Saudara)</label>
                                        <input type="text" name="kontak_darurat" class="form-control" value="{{ Request::old('kontak_darurat') }}">
                                        <span class="help-block">{{ $errors->first('kontak_darurat') }}</span>
                                    </div>
                                </div>
            
                                <div class="row">
                                    @if ($errors->any('alamat'))
                                        <div class="form-group has-error col-md-12">
                                    @else
                                        <div class="form-group col-md-12">
                                    @endif
            
                                        <label class="form-label">Alamat</label>
                                        <textarea rows="2" class="form-control" name="alamat">{{ Request::old('alamat') }}</textarea>
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
                                        <textarea rows="2" class="form-control" name="domisili">{{ Request::old('domisili') }}</textarea>
                                        <span class="help-block">{{ $errors->first('domisili') }}</span>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    @if ($errors->any('rek_bank'))
                                        <div class="form-group has-error col-md-6">
                                    @else
                                        <div class="form-group col-md-6">
                                    @endif
                                        <label class="form-label">No. Rekening Bank BCA</label>
                                        <input type="text" name="rek_bank" class="form-control" value="{{ Request::old('rek_bank') }}">
                                        <span class="help-block">{{ $errors->first('rek_bank') }}</span>
                                    </div>
                                    
                                    @if ($errors->any('jabatan'))
                                        <div class="form-group has-error col-md-6">
                                    @else
                                        <div class="form-group col-md-6">
                                    @endif
                                        <label>Jabatan</label>
                                        <select class="js-example-basic-single w-100" name="jabatan" id="single4">
                                            <option value="">-- Pilih Jabatan --</option>                                
                                            @foreach ($Jabatan as $j)
                                                <option value="{{ $j->id }}" {{ Request::old('jabatan') == $j->id ? "selected" : "" }}>{{ $j->nama }} - Rp. {{ number_format($j->simp_wajib,2) }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">{{ $errors->first('jabatan') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Upload Foto KTP</label>
                                            <input type="file" name="filename" class="file-upload-default" id="fileupload">
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
                                    <div class="col-md-12">
                                        <blockquote class="blockquote">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="card-title">Syarat dan Ketentuan</p>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                              <input type="checkbox" class="form-check-input" name="confirm1">
                                                              Sebagai anggota koperasi saya bersedia untuk menjalankan segala aturan yang tertuang dalam Anggaran Dasar, Anggaran Rumah Tangga Koperasi dan peraturan lain yang terkait.
                                                            </label>
                                                          </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                        
                                                              <input type="checkbox" class="form-check-input" name="confirm2">
                                                              
                                                              Saya memberikan kuasa kepada KOPERASI KARYAWAN PARAGON UNTUNG BARENG untuk memotong gaji terkait kewajiban anggota (simpanan pokok & simpanan wajib), juga jika melakukan simpan pinjam
                                                            </label>
                                                          </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </blockquote>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pull-right">
                                            <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Kirim Formulir Pendaftaran</button>
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
    </div>
    <!-- plugins:js -->
    <script src="{{ asset('public/admin/template') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('public/admin/template') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('public/admin/template') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('public/admin/template') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/dataTables.select.min.js"></script>


    <script src="{{ asset('public/admin/template') }}/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/select2.js"></script>


    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/admin/template') }}/js/off-canvas.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/template.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/file-upload.js"></script>

    <script src="{{ asset('public/admin/template') }}/js/settings.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('public/admin/template') }}/js/dashboard.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/Chart.roundedBarCharts.js"></script>

</body>
</html>