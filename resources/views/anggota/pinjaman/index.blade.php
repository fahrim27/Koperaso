@extends('layouts_anggota.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pinjaman</h3>
                  <div class="card-options">
                    <blockquote class="blockquote">
                        <h4>{{ $NamaAgt }}</h4>
                        <h5>{{ $Perush }}</h5>
                    </blockquote>                                     
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. Rekening</th>
                            <th>Jth Tempo</th>
                            <th>Nama Pinjaman</th>
                            <th>Jml Pinjaman</th>
                            <th>Jangka</th>
                            <th>Sisa Pinjaman</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PbyRekening as $Pby)
                            <tr>
                                <td>{{ $Pby->no_rek }}</td>
                                <td>{{ $Pby->jth_tempo }}</td>
                                <td>{{ $Pby->PbyMaster->nama }}</td>
                                <td align="right">{{ number_format($Pby->plafond,2) }}</td>
                                <td>{{ $Pby->jangka }} Bulan</td>
                                <td>{{ number_format($Pby->saldo_akhir,2) }}</td>
                                <td>
                                    @if ($Pby->status)
                                        <div class="badge badge-success">Aktif</div>                                        
                                    @else
                                    <div class="badge badge-info">Lunas</div>
                                    @endif
                                    
                                </td>
                                <td width="5%">
                                    <a href="{{ url('anggota/pinjaman/detail/'.$Pby->id) }}" data-toggle="tooltip" data-placement="top" title="Detail Pinjaman">
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
