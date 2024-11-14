@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pengajuan Pinjaman</h3>
                  <div class="card-options">
                    <form action="{{url('admin/simp_rekening/filter')}}" method="POST">
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

                            <a href="{{ url('/admin/pengajuan/addnew') }}" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Buat Pengajuan Baru</a> 
                          </div>
                        </div>
                      </div>
                    </form>                      
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Status</th>
                            <th>No. Pengajuan</th>
                            <th>Tgl Pengajuan</th>
                            <th>Nama Anggota</th>
                            <th>Nama Pinjaman</th>
                            <th>Nominal</th>
                            <th>Jangka</th>
                            <th>Keperluan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PbyPengajuan as $Pby)
                            <tr>
                                <td>
                                  <a href="{{ url('admin/pengajuan/detail/'.$Pby->id) }}" data-toggle="tooltip" data-placement="top" title="Lihat Pengajuan">
                                      <i class="fa fa-fw fa-info-circle"></i></a>
                                    <a href="{{ url('admin/pengajuan/download/'.$Pby->id) }}" data-toggle="tooltip" data-placement="top" title="Cetak Pengajuan Anggota">
                                        <i class="fa fa-fw fa-print"></i></a>
                                </td>
                                <td>
                                  @switch($Pby->status_pengajuan)
                                      @case('Menunggu Persetujuan HR')
                                        <div class="badge badge-warning">Menunggu Persetujuan HR</div>
                                        @break
                                      @case('Menunggu Persetujuan CFO')
                                        <div class="badge badge-warning">Menunggu Persetujuan CFO</div>
                                        @break
                                      @case('Menunggu Pencairan')
                                        <div class="badge badge-warning">Menunggu Pencairan</div>
                                        @break
                                      @case("Ditolak")
                                      <div class="badge badge-danger">Ditolak</div>
                                        @break
                                      @case("Pencairan Selesai")
                                        <div class="badge badge-success">Pencairan Selesai</div>
                                        @break                                          
                                  @endswitch
                                </td>
                                <td>{{ $Pby->no_pengajuan }}</td>
                                <td>{{ $Pby->tanggal }}</td>
                                <td>{{ $Pby->Anggota->nama_anggota }}</td>
                                <td>{{ $Pby->PbyMaster->nama }}</td>
                                <td align="right">{{ number_format($Pby->nominal,2) }}</td>
                                <td>{{ $Pby->jangka }} Bulan</td>
                                <td>{{ $Pby->keperluan }}</td>
                                <td>{{ $Pby->keterangan }}</td>
                            </tr>                            
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modelhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Hapus Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah akun tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/master_akun/hapus')}}" method="POST">
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
