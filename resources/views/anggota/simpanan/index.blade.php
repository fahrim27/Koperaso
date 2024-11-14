@extends('layouts_anggota.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Rekening Simpanan</h3>
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
                            <th>Nama Simpanan</th>
                            <th>Saldo Simpanan</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($SimpRek as $Simp)
                            <tr>
                                <td width="5%">{{ $Simp->no_rek }}</td>
                                <td>{{ $Simp->SimpMaster->nama }}</td>
                                <td align="right">{{ number_format($Simp->saldo_akhir,2) }}</td>
                                <td width="5%">
                                    @if ($Simp->status_aktif == 'Y')
                                        <div class="badge badge-success">Aktif</div>                                        
                                    @else
                                    <div class="badge badge-danger">Non Aktif</div>
                                    @endif
                                </td>
                                <td width="5%">
                                    <a href="{{ url('anggota/simpanan/detail/'.$Simp->id) }}" data-toggle="tooltip" data-placement="top" title="Lihat Mutasi">
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
