<script type="javascript">
    {{--  var dataShu = {!! json_encode($DataShu->toArray(), JSON_HEX_TAG) !!};  --}}
    var jan     = {{ $Jan }};
</script>
@extends('layouts.app')
@section('content-app')
    {{--  @include('message.flash')  --}}
            <div class="row">
                {{--  {{ companySetting('nama_koperasi') }} - {{ companySetting('alm_koperasi') }}  --}}
                

                <div class="col-md-12 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                        <img src="https://png.pngtree.com/png-vector/20191103/ourlarge/pngtree-handsome-young-guy-avatar-cartoon-style-png-image_1947775.jpg" class="img-lg rounded" alt="profile image"/>
                                        <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <h6 class="mb-0">{{ $NamaUser }}</h6>
                                            <p class="text-muted mb-1">{{ $Email }}</p>
                                            <p class="mb-0 text-success font-weight-bold">{{ $Depart }}</p>
                                            {{--  <p class="text-secondary">Status Anggota {{ $StsAnggota }}</p>  --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Anggota</p>
                                    <p class="fs-30 mb-2">{{ $JmlAnggota }}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Simpanan</p>
                                    <p class="fs-30 mb-2">Rp. {{ number_format($JmlSimp,2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Pinjaman</p>
                                    <p class="fs-30 mb-2">Rp. {{ number_format($JmlPby,2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- content-wrapper ends -->
            </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                     <div class="d-flex justify-content-between">
                      <p class="card-title">Perkembangan SHU </p>
                     </div>
                      
                     <div id="shu-legend" class="chartjs-legend mt-4 mb-2"></div>
                     <canvas id="shu-chart"></canvas>
                     <input type="hidden" name="jan" id="shuJan" value="{{ $Jan }}">
                     <input type="hidden" name="jan" id="shuFeb" value="{{ $Feb }}">
                     <input type="hidden" name="jan" id="shuMar" value="{{ $Mar }}">
                     <input type="hidden" name="jan" id="shuApr" value="{{ $Apr }}">
                     <input type="hidden" name="jan" id="shuMei" value="{{ $Mei }}">
                     <input type="hidden" name="jan" id="shuJun" value="{{ $Jun }}">
                     <input type="hidden" name="jan" id="shuJul" value="{{ $Jul }}">
                     <input type="hidden" name="jan" id="shuAgt" value="{{ $Agt }}">
                     <input type="hidden" name="jan" id="shuSep" value="{{ $Sep }}">
                     <input type="hidden" name="jan" id="shuOkt" value="{{ $Okt }}">
                     <input type="hidden" name="jan" id="shuNov" value="{{ $Nov }}">
                     <input type="hidden" name="jan" id="shuDes" value="{{ $Des }}">

                     <script>
                        var shuJan = document.getElementById('shuJan').value;
                        var shuFeb = document.getElementById('shuFeb').value;
                        var shuMar = document.getElementById('shuMar').value;
                        var shuApr = document.getElementById('shuApr').value;
                        var shuMei = document.getElementById('shuMei').value;
                        var shuJun = document.getElementById('shuJun').value;
                        var shuJul = document.getElementById('shuJul').value;
                        var shuAgt = document.getElementById('shuAgt').value;
                        var shuSep = document.getElementById('shuSep').value;
                        var shuOkt = document.getElementById('shuOkt').value;
                        var shuNov = document.getElementById('shuNov').value;
                        var shuDes = document.getElementById('shuDes').value;

                    </script>
                    </div>
                  </div>
            </div>
        </div>

@endsection
