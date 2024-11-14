@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pengajuan Pinjaman</h3>
            <div class="card-options">
                <form action="{{ url('admin/simp_rekening/filter') }}" method="POST">
                    {{--  <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Filter Simpanan</label>
                            <select class="js-example-basic-single w-100" name="kdesimp" id="single" autofocus>
                                <option value="">-- Pilih Simpanan --</option>
                                @foreach ($SimpMaster as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                @endforeach
                            </select>
                          </div>                          
                        </div>
                      </div>  --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{--  <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-table"></i> Tampilkan</button>  --}}

                                <a href="{{ url('/admin/pengajuan/addnew') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-file"></i> Buat Pengajuan Baru</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab"
                        aria-controls="nav-all" aria-selected="true">Semua Pengajuan</a>

                    <a class="nav-item nav-link" id="nav-approvehr-tab" data-toggle="tab" href="#nav-approvehr"
                        role="tab" aria-controls="nav-approvehr" aria-selected="false">Disetujui HR</a>

                    <a class="nav-item nav-link" id="nav-approvecfo-tab" data-toggle="tab" href="#nav-approvecfo"
                        role="tab" aria-controls="nav-approvecfo" aria-selected="false">Disetujui CFO</a>

                    <a class="nav-item nav-link" id="nav-reject-tab" data-toggle="tab" href="#nav-reject" role="tab"
                        aria-controls="nav-reject" aria-selected="false">Tidak Disetujui</a>

                    {{--  <a class="nav-item nav-link" id="nav-pencairan-tab" data-toggle="tab" href="#nav-pencairan"
                        role="tab" aria-controls="nav-pencairan" aria-selected="false">Menunggu Pencairan</a>  --}}
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                {{-- --  Semua Pengajuan  --- --}}
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Anggota</th>
                                <th>Nama Pinjaman</th>
                                <th>Nominal</th>
                                <th>Jangka</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AllPengajuan as $All)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($All->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $All->Anggota->nama_anggota }}</td>
                                    <td>{{ $All->PbyMaster->nama }}</td>
                                    <td align="right">{{ number_format($All->nominal, 2) }}</td>
                                    <td>{{ $All->jangka }} Bulan</td>
                                    <td>
                                        @switch($All->status_pengajuan)
                                            @case('Menunggu Persetujuan HR')
                                                <span class="badge badge-warning">Menunggu Persetujuan HR</span>
                                            @break

                                            @case('Menunggu Persetujuan CFO')
                                                <span class="badge badge-warning">Menunggu Persetujuan CFO</span>
                                            @break

                                            @case('Menunggu Pencairan')
                                                <span class="badge badge-info">Menunggu Pencairan</span>
                                            @break

                                            @case('Tidak Disetujui')
                                                <span class="badge badge-danger">Tidak Disetujui</span>
                                            @break

                                            @case('Pencairan Dibatalkan')
                                                <span class="badge badge-danger">Pencairan Dibatalkan</span>
                                            @break

                                            @case('Tidak Disetujui HR')
                                                <span class="badge badge-danger">Tidak Disetujui HR</span>
                                            @break

                                            @case('Tidak Disetujui CFO')
                                                <span class="badge badge-danger">Tidak Disetujui CFO</span>
                                            @break

                                            @case('Pencairan Selesai')
                                                <span class="badge badge-success">Pencairan Selesai</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if (userHelpers('department') == 'HR')
                                            @if ($All->status_pengajuan == 'Menunggu Persetujuan HR')
                                                <a href="{{ url('/admin/pengajuan/edit/'.$All->id) }}" title="Edit Pengajuan">
                                                    <i class="fa fa-fw fa-edit"></i></a>
                                            @endif
                                        @endif 
                                        <a href="{{ url('admin/pengajuan/detail/' . $All->id) }}" data-toggle="tooltip"
                                            data-placement="top" title="Lihat Pengajuan">
                                            <i class="fa fa-fw fa-info-circle"></i></a>

                                        <a href="{{ url('admin/pengajuan/download/' . $All->id) }}" data-toggle="tooltip"
                                            data-placement="top" title="Cetak Pengajuan Anggota">
                                            <i class="fa fa-fw fa-print"></i></a>
                                        @if (userHelpers('department') == 'HR')
                                            @if ($All->status_pengajuan == 'Menunggu Persetujuan HR')
                                                <a href="#modalsetuju" onclick="$('#idsetuju').val({{ $All->id }})"
                                                    data-toggle="modal" title="Setujui Pengajuan">
                                                    <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>

                                                <a href="#modaltolak" onclick="$('#idtolak').val({{ $All->id }})"
                                                    data-toggle="modal" title="Tolak Pengajuan">
                                                    <i class="fa fa-fw fa-times-circle" style="color:red;"></i></a>
                                            @endif
                                        @endif
                                        @if (userHelpers('department') == 'CFO')
                                            @if ($All->status_pengajuan == 'Menunggu Persetujuan CFO')
                                                <a href="#modalsetuju" onclick="$('#idsetuju').val({{ $All->id }})"
                                                    data-toggle="modal" title="Setujui Pengajuan">
                                                    <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>

                                                <a href="#modaltolak" onclick="$('#idtolak').val({{ $All->id }})"
                                                    data-toggle="modal" title="Tolak Pengajuan">
                                                    <i class="fa fa-fw fa-times-circle" style="color:red;"></i></a>
                                            @endif
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{--  Approve HR  --}}
                <div class="tab-pane fade show" id="nav-approvehr" role="tabpanel" aria-labelledby="nav-approvehr-tab">
                    <table id="tabel-data-3" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Anggota</th>
                                <th>Nama Pinjaman</th>
                                <th>Nominal</th>
                                <th>Jangka</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ApproveHr as $ApHr)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($ApHr->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $ApHr->Anggota->nama_anggota }}</td>
                                    <td>{{ $ApHr->PbyMaster->nama }}</td>
                                    <td align="right">{{ number_format($ApHr->nominal, 2) }}</td>
                                    <td>{{ $ApHr->jangka }} Bulan</td>
                                    <td>
                                        @switch($ApHr->status_pengajuan)
                                            @case('Menunggu Persetujuan HR')
                                                <span class="badge badge-warning">Menunggu Persetujuan HR</span>
                                            @break

                                            @case('Menunggu Persetujuan CFO')
                                                <span class="badge badge-warning">Menunggu Persetujuan CFO</span>
                                            @break

                                            @case('Menunggu Pencairan')
                                                <span class="badge badge-info">Menunggu Pencairan</span>
                                            @break

                                            @case('Tidak Disetujui')
                                                <span class="badge badge-danger">Tidak Disetujui</span>
                                            @break

                                            @case('Pencairan Dibatalkan')
                                                <span class="badge badge-danger">Pencairan Dibatalkan</span>
                                            @break

                                            @case('Tidak Disetujui HR')
                                                <span class="badge badge-danger">Tidak Disetujui HR</span>
                                            @break

                                            @case('Tidak Disetujui CFO')
                                                <span class="badge badge-danger">Tidak Disetujui CFO</span>
                                            @break

                                            @case('Pencairan Selesai')
                                                <span class="badge badge-success">Pencairan Selesai</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/pengajuan/detail/' . $ApHr->id) }}" data-toggle="tooltip"
                                            data-placement="top" title="Lihat Pengajuan">
                                            <i class="fa fa-fw fa-info-circle"></i></a>

                                        <a href="{{ url('admin/pengajuan/download/' . $ApHr->id) }}"
                                            data-toggle="tooltip" data-placement="top" title="Cetak Pengajuan Anggota">
                                            <i class="fa fa-fw fa-print"></i></a>
                                        @if ($ApHr->status_pengajuan == 'Menunggu Persetujuan HR')
                                            <a href="#modalsetuju" onclick="$('#idsetuju').val({{ $All->id }})"
                                                data-toggle="modal" title="Setujui Pengajuan">
                                                <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>

                                            <a href="#modaltolak" onclick="$('#idtolak').val({{ $ApHr->id }})"
                                                data-toggle="modal" title="Tolak Pengajuan">
                                                <i class="fa fa-fw fa-times-circle" style="color:red;"></i></a>
                                        @endif
                                        @if ($ApHr->status_pengajuan == 'Menunggu Persetujuan CFO')
                                            <a href="#modaltolak" onclick="$('#idtolak').val({{ $ApHr->id }})"
                                                data-toggle="modal" data-placement="top" title="Batalkan Persetujuan"><i
                                                    class="fa fa-fw fa-times-circle" style="color:red;"></i></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{-- --  Approve CFO  --- --}}
                <div class="tab-pane fade show" id="nav-approvecfo" role="tabpanel"
                    aria-labelledby="nav-approvecfo-tab">
                    <table id="tabel-data-2" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Anggota</th>
                                <th>Nama Pinjaman</th>
                                <th>Nominal</th>
                                <th>Jangka</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ApproveCfo as $ApCfo)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($ApCfo->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $ApCfo->Anggota->nama_anggota }}</td>
                                    <td>{{ $ApCfo->PbyMaster->nama }}</td>
                                    <td align="right">{{ number_format($ApCfo->nominal, 2) }}</td>
                                    <td>{{ $ApCfo->jangka }} Bulan</td>
                                    <td>
                                        @switch($ApCfo->status_pengajuan)
                                            @case('Menunggu Persetujuan HR')
                                                <span class="badge badge-warning">Menunggu Persetujuan HR</span>
                                            @break

                                            @case('Menunggu Persetujuan CFO')
                                                <span class="badge badge-warning">Menunggu Persetujuan CFO</span>
                                            @break

                                            @case('Menunggu Pencairan')
                                                <span class="badge badge-info">Menunggu Pencairan</span>
                                            @break

                                            @case('Tidak Disetujui')
                                                <span class="badge badge-danger">Tidak Disetujui</span>
                                            @break

                                            @case('Pencairan Dibatalkan')
                                                <span class="badge badge-danger">Pencairan Dibatalkan</span>
                                            @break

                                            @case('Tidak Disetujui HR')
                                                <span class="badge badge-danger">Tidak Disetujui HR</span>
                                            @break

                                            @case('Tidak Disetujui CFO')
                                                <span class="badge badge-danger">Tidak Disetujui CFO</span>
                                            @break

                                            @case('Pencairan Selesai')
                                                <span class="badge badge-success">Pencairan Selesai</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/pengajuan/detail/' . $ApCfo->id) }}" data-toggle="tooltip"
                                            data-placement="top" title="Lihat Pengajuan">
                                            <i class="fa fa-fw fa-info-circle"></i></a>

                                        <a href="{{ url('admin/pengajuan/download/' . $ApCfo->id) }}"
                                            data-toggle="tooltip" data-placement="top" title="Cetak Pengajuan Anggota">
                                            <i class="fa fa-fw fa-print"></i></a>

                                        @if ($ApCfo->status_pengajuan == 'Menunggu Pencairan')
                                            <a href="#modaltolak" onclick="$('#idtolak').val({{ $ApCfo->id }})"
                                                data-toggle="modal" data-placement="top" title="Batalkan Persetujuan"><i
                                                    class="fa fa-fw fa-times-circle" style="color:red;"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{--  TIDAK DISETUJUI  --}}
                <div class="tab-pane fade show" id="nav-reject" role="tabpanel" aria-labelledby="nav-reject-tab">
                    <table id="tabel-data-4" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Anggota</th>
                                <th>Nama Pinjaman</th>
                                <th>Nominal</th>
                                <th>Jangka</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Reject as $Rej)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($Rej->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $Rej->Anggota->nama_anggota }}</td>
                                    <td>{{ $Rej->PbyMaster->nama }}</td>
                                    <td align="right">{{ number_format($Rej->nominal, 2) }}</td>
                                    <td>{{ $Rej->jangka }} Bulan</td>
                                    <td>
                                        @switch($Rej->status_pengajuan)
                                            @case('Menunggu Persetujuan HR')
                                                <span class="badge badge-warning">Menunggu Persetujuan HR</span>
                                            @break

                                            @case('Menunggu Persetujuan CFO')
                                                <span class="badge badge-warning">Menunggu Persetujuan CFO</span>
                                            @break

                                            @case('Menunggu Pencairan')
                                                <span class="badge badge-info">Menunggu Pencairan</span>
                                            @break

                                            @case('Tidak Disetujui')
                                                <span class="badge badge-danger">Tidak Disetujui</span>
                                            @break

                                            @case('Pencairan Dibatalkan')
                                                <span class="badge badge-danger">Pencairan Dibatalkan</span>
                                            @break

                                            @case('Tidak Disetujui HR')
                                                <span class="badge badge-danger">Tidak Disetujui HR</span>
                                            @break

                                            @case('Tidak Disetujui CFO')
                                                <span class="badge badge-danger">Tidak Disetujui CFO</span>
                                            @break

                                            @case('Pencairan Selesai')
                                                <span class="badge badge-success">Pencairan Selesai</span>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="modaltolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tolak Pengajuan Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/pengajuan/update') }}" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Alasan Penolakan</label>
                            <input type="text" name="keterangan" class="form-control">
                            <span class="help-block">{{ $errors->first('keterangan') }}</span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idtolak" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Ditolak">
                        <input type="hidden" name="sts_hr" value="Ditolak HR">
                        <input type="hidden" name="sts_cfo" value="Ditolak CFO">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-danger" value="Tolak Pengajuan">
                    </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modalsetuju" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Setujui Pengajuan Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pengajuan pinjaman tersebut akan disetujui ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/pengajuan/update') }}" method="POST">
                        <input type="hidden" id="idsetuju" name="id" value="">
                        <input type="hidden" name="sts_pengajuan" value="Disetujui">
                        <input type="hidden" name="sts_hr" value="Disetujui HR">
                        <input type="hidden" name="sts_cfo" value="Disetujui CFO">


                        <input type="hidden" name="keterangan" value="">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-success" value="Setujui Pengajuan">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
