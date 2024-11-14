@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pencairan Pinjaman</h3>
        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab"
                        aria-controls="nav-all" aria-selected="true">Semua Pengajuan</a>

                    <a class="nav-item nav-link" id="nav-proses-tab" data-toggle="tab" href="#nav-proses"
                        role="tab" aria-controls="nav-proses" aria-selected="false">Menunggu Pencairan</a>

                    <a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab" href="#nav-selesai"
                        role="tab" aria-controls="nav-selesai" aria-selected="false">Selesai Pencairan</a>

                    <a class="nav-item nav-link" id="nav-batal-tab" data-toggle="tab" href="#nav-batal"
                        role="tab" aria-controls="nav-batal" aria-selected="false">Pembatalan Pencairan</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                {{-- --  Semua Pengajuan  --- --}}
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tgl Desetujui</th>
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
                                    <td>{{ \Carbon\Carbon::parse($All->tgl_ubah)->format('d-m-Y') }}</td>
                                    <td>{{ $All->Anggota->nama_anggota }}</td>
                                    <td>{{ $All->PbyMaster->nama }}</td>
                                    <td align="right">{{ number_format($All->nominal, 2) }}</td>
                                    <td>{{ $All->jangka }} Bulan</td>
                                    <td>
                                        @switch($All->status_pengajuan)
                                            @case('Menunggu Pencairan')
                                                <span class="badge badge-warning">Menunggu Pencairan</span>
                                            @break

                                            @case('Pencairan Dibatalkan')
                                                <span class="badge badge-danger">Pencairan Dibatalkan</span>
                                            @break

                                            @case('Pencairan Selesai')
                                                <span class="badge badge-success">Pencairan Selesai</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/pengajuan/detail/' . $All->id) }}" data-toggle="tooltip"
                                            data-placement="top" title="Lihat Detail">
                                            <i class="fa fa-fw fa-info-circle"></i></a>

                                        @if ((userHelpers('department') == 'USP' || userHelpers('department') == 'ADMIN') && $All->status_pengajuan == 'Menunggu Pencairan')
                                            <a href="#modalcair" onclick="$('#idpinjaman').val({{$All->id}})"
                                                data-toggle="modal" title="Proses Pencairan">
                                                <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>

                                            <a href="#modaltolak" onclick="$('#idtolak').val({{ $All->id }})"
                                                data-toggle="modal" title="Batalkan Pencairan">
                                                <i class="fa fa-fw fa-times-circle" style="color:red;"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{-- --  Menunggu Pencairan  --- --}}
                <div class="tab-pane fade show" id="nav-proses" role="tabpanel" aria-labelledby="nav-proses-tab">
                  <table id="tabel-data-2" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Tgl Desetujui</th>
                              <th>Nama Anggota</th>
                              <th>Nama Pinjaman</th>
                              <th>Nominal</th>
                              <th>Jangka</th>
                              <th>Status</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($ProsesCair as $Proses)
                              <tr>
                                  <td>{{ \Carbon\Carbon::parse($Proses->tgl_ubah)->format('d-m-Y') }}</td>
                                  <td>{{ $Proses->Anggota->nama_anggota }}</td>
                                  <td>{{ $Proses->PbyMaster->nama }}</td>
                                  <td align="right">{{ number_format($Proses->nominal, 2) }}</td>
                                  <td>{{ $Proses->jangka }} Bulan</td>
                                  <td>
                                      @switch($Proses->status_pengajuan)
                                          @case('Menunggu Pencairan')
                                              <span class="badge badge-warning">Menunggu Pencairan</span>
                                          @break

                                          @case('Pencairan Dibatalkan')
                                              <span class="badge badge-danger">Pencairan Dibatalkan</span>
                                          @break

                                          @case('Pencairan Selesai')
                                              <span class="badge badge-success">Pencairan Selesai</span>
                                          @break
                                      @endswitch
                                  </td>
                                  <td>
                                      <a href="{{ url('admin/pengajuan/detail/' . $Proses->id) }}" data-toggle="tooltip"
                                          data-placement="top" title="Lihat Detail">
                                          <i class="fa fa-fw fa-info-circle"></i></a>

                                      @if ((userHelpers('department') == 'USP' || userHelpers('department') == 'ADMIN') && $Proses->status_pengajuan == 'Menunggu Pencairan')
                                          <a href="#modalcair" onclick="$('#idpinjaman').val({{$Proses->id}})"
                                              data-toggle="modal" title="Proses Pencairan">
                                              <i class="fa fa-fw fa-check-circle" style="color:green;"></i></a>

                                          <a href="#modaltolak" onclick="$('#idtolak').val({{ $Proses->id }})"
                                              data-toggle="modal" title="Batalkan Pencairan">
                                              <i class="fa fa-fw fa-times-circle" style="color:red;"></i></a>
                                      @endif
                                  </td>
                              </tr>
                          @endforeach

                      </tbody>
                  </table>
              </div>

              {{-- --  Selesai Pencairan  --- --}}
              <div class="tab-pane fade show" id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab">
                <table id="tabel-data-3" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tgl Desetujui</th>
                            <th>Nama Anggota</th>
                            <th>Nama Pinjaman</th>
                            <th>Nominal</th>
                            <th>Jangka</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($SelesaiCair as $Sls)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($Sls->tgl_ubah)->format('d-m-Y') }}</td>
                                <td>{{ $Sls->Anggota->nama_anggota }}</td>
                                <td>{{ $Sls->PbyMaster->nama }}</td>
                                <td align="right">{{ number_format($Sls->nominal, 2) }}</td>
                                <td>{{ $Sls->jangka }} Bulan</td>
                                <td>
                                    @switch($Sls->status_pengajuan)
                                        @case('Menunggu Pencairan')
                                            <span class="badge badge-warning">Menunggu Pencairan</span>
                                        @break

                                        @case('Pencairan Dibatalkan')
                                            <span class="badge badge-danger">Pencairan Dibatalkan</span>
                                        @break

                                        @case('Pencairan Selesai')
                                            <span class="badge badge-success">Pencairan Selesai</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ url('admin/pengajuan/detail/'.$Sls->id) }}" data-toggle="tooltip"
                                        data-placement="top" title="Lihat Detail">
                                        <i class="fa fa-fw fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            
            {{-- --  Selesai Pencairan  --- --}}
              <div class="tab-pane fade show" id="nav-batal" role="tabpanel" aria-labelledby="nav-batal-tab">
                <table id="tabel-data-4" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tgl Disetujui</th>
                            <th>Nama Anggota</th>
                            <th>Nama Pinjaman</th>
                            <th>Nominal</th>
                            <th>Jangka</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($BatalCair as $Btl)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($Btl->tgl_ubah)->format('d-m-Y') }}</td>
                                <td>{{ $Btl->Anggota->nama_anggota }}</td>
                                <td>{{ $Btl->PbyMaster->nama }}</td>
                                <td align="right">{{ number_format($Btl->nominal, 2) }}</td>
                                <td>{{ $Btl->jangka }} Bulan</td>
                                <td>
                                    @switch($Btl->status_pengajuan)
                                        @case('Menunggu Pencairan')
                                            <span class="badge badge-warning">Menunggu Pencairan</span>
                                        @break

                                        @case('Pencairan Dibatalkan')
                                            <span class="badge badge-danger">Pencairan Dibatalkan</span>
                                        @break

                                        @case('Pencairan Selesai')
                                            <span class="badge badge-success">Pencairan Selesai</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ url('admin/pengajuan/detail/'. $Btl->id) }}" data-toggle="tooltip"
                                        data-placement="top" title="Lihat Detail">
                                        <i class="fa fa-fw fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaltolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{ url('admin/pengajuan/update') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Pembatalan Pencairan Pinjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Alasan Pembatalan</label>
                            <input type="text" name="keterangan"class="form-control">
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
                        <input type="submit" class="btn btn-danger" value="Batalkan Pencairan">

                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modalcair" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Pencairan Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pinjaman tersebut akan dicairkan ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/pencairan/proses') }}" method="POST">
                        <input type="hidden" id="idpinjaman" name="id" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary" value="Proses Pencairan">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
