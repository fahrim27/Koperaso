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
                    <a href="{{ url('/anggota/simpanan/setoran/addnew') }}" class="btn btn-sm btn-pill btn-primary">Transaksi Baru</a>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($AgtTrx as $Simp)
                            <tr>
                                <td width="5%">{{ $Simp->SimpRekening->no_rek }}</td>
                                <td>{{ $Simp->SimpRekening->SimpMaster->nama }}</td>
                                <td align="right">Rp. {{ number_format($Simp->nominal,2) }}</td>
                                <td width="5%">
                                    @if ($Simp->status == 'Berhasil')
                                        <div class="badge badge-success">Berhasil</div>                                        
                                    @else
                                    <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                    @endif

                                  @if ($Simp->status == 'Menunggu Konfirmasi')
                                    <a href="#modelhapus" onclick="$('#idhapus').val({{$Simp->id}})" data-toggle="modal" data-placement="top"  title="Hapus Transaksi">
                                      <i class="fa fa-fw fa-trash"></i></a>
                                  @endif
                                      {{--  <a href="{{ url('anggota/simpanan/setoran/detail/'.$Simp->id) }}" data-toggle="tooltip" data-placement="top" title="Lihat Transaksi">
                                          <i class="fa fa-fw fa-info-circle"></i></a>  --}}
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
          <h5 class="modal-title" id="myModalLabel">Hapus Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah transaksi tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('anggota/simpanan/setoran/hapus')}}" method="POST">
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
