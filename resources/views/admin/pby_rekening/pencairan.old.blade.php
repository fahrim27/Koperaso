@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pencairan Pinjaman</h3>
                  <div class="card-options">
                                     
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No. Pengajuan</th>
                            <th>Tgl Disetujui</th>
                            <th>Nama Anggota</th>
                            <th>Nama Pinjaman</th>
                            <th>Nominal</th>
                            <th>Jangka</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PbyPengajuan as $Pby)
                            <tr>
                                <td>
                                  <a href="{{ url('admin/pengajuan/detail/'.$Pby->id) }}" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                                      <i class="fa fa-fw fa-info-circle"></i></a>
                                </td>
                                
                                <td>{{ $Pby->no_pengajuan }}</td>
                                <td>{{ $Pby->tgl_ubah  }}</td>
                                <td>{{ $Pby->Anggota->nama_anggota }}</td>
                                <td>{{ $Pby->PbyMaster->nama }}</td>
                                <td align="right">{{ number_format($Pby->nominal,2) }}</td>
                                <td>{{ $Pby->jangka }} Bulan</td>
                                <td>   
                                  @if ($Pby->status_pengajuan == "Menunggu Pencairan")
                                    <a href="#modalcair" onclick="$('#idpinjaman').val({{$Pby->id}})" data-toggle="modal" data-placement="top"  title="Proses Pencairan"><div class="badge badge-warning">Menunggu Pencairan</div></a>  
                                  @else
                                    <a href="#"><div class="badge badge-primary">Sudah Dicairkan</div></a>  
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
<div class="modal fade" id="modalcair" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
          <form action="{{url('admin/pencairan/proses')}}" method="POST">
            <input type="hidden" id="idpinjaman" name="id" value="">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
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
