@extends('layouts_anggota.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pengajuan Pinjaman</h3>
                  <div class="card-options">
                    <blockquote class="blockquote">
                        <h4>{{ $NamaAgt }}</h4>
                        <h5>{{ $Perush }}</h5>
                    </blockquote>  
                       
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <a href="{{ url('/anggota/pengajuan/addnew') }}" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Buat Pengajuan Baru</a> 
                        </div>
                      </div>
                    </div>                                         
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pinjaman</th>
                            <th>Nominal Pinjaman</th>
                            <th>Jangka</th>
                            <th>Keperluan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PbyPengajuan as $Pby)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($Pby->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $Pby->PbyMaster->nama }}</td>
                                <td align="right">{{ number_format($Pby->nominal,2) }}</td>
                                <td>{{ $Pby->jangka }} Bulan</td>
                                <td>{{ $Pby->keperluan }}</td>
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
                                    @case("Tidak Disetujui")
                                    <div class="badge badge-danger">Tidak Disetujui</div>
                                      @break
                                      @case("Tidak Disetujui HR")
                                    <div class="badge badge-danger">Tidak Disetujui</div>
                                      @break
                                      @case("Tidak Disetujui CFO")
                                    <div class="badge badge-danger">Tidak Disetujui</div>
                                      @break
                                    @case("Pencairan Selesai")
                                      <div class="badge badge-success">Pencairan Selesai</div>
                                      @break                                          
                                  @endswitch
                                    {{--  <p><small class="text-muted">
                                      {{ $Pby->keterangan }}</small></p>  --}}
                                  </td>
                                  <td>
                                    {{ $Pby->keterangan }}
                                  </td>
                                  <td>
                                    <a href="#" data-toggle="tooltips" data-placement="top"  title="Lihat Pengajuan"><i class="fa fa-fw fa-info-circle"></i></a>
                                    @if ($Pby->status_pengajuan == "Menunggu Persetujuan HR")
                                      <a href="#modelhapus" onclick="$('#idhapus').val({{$Pby->id}})" data-toggle="modal" data-placement="top"  title="Batalkan Pengajuan"><i class="fa fa-fw fa-trash" style="color:red"></i></a>
                                    @endif                                    
                                  </td>
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
          <h5 class="modal-title" id="myModalLabel">Batalkan Pengajuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah pengajuan pinjaman tersebut akan dibatalkan ?
        </div>
        <div class="modal-footer">
          <form action="{{url('anggota/pengajuan/batal')}}" method="POST">
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
