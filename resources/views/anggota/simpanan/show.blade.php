@extends('layouts_anggota.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mutasi Rekening Simpanan</h3>
                  <div class="card-options">
                    <blockquote class="blockquote">
                        <h4>{{ $SimpRek->Anggota->nama_anggota }}</h4>
                        <h5>{{ $SimpRek->no_rek }} - {{ $SimpRek->SimpMaster->nama }}</h5>
                        <h5><b>Saldo Akhir : Rp. {{ number_format($SimpRek->saldo_akhir,2) }}</b></h5>
                    </blockquote>
                    <form action="{{url('admin/simp_mutasi/filter')}}" method="POST">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Filter Periode</label>
                            <input type="date" name="tgl_mulai" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
                          </div>                          
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>&nbsp;</label>
                              <input type="date" name="tgl_selesai" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            </div>                          
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="no_rek" value="{{ $SimpRek->no_rek }}">
                            <input type="hidden" name="id" value="{{ $SimpRek->id }}">
                            <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-table"></i> Tampilkan</button>
                          </div>
                        </div>
                      </div>
                    </form>                      
                </div>
            </div>
            <div class="card-body">
                <table id="#" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Transaksi</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            {{--  <th></th>  --}}
                        </tr>                  
                    </thead>
                    <tbody>
                        @if ($SimpMutasi <> [])
                            @foreach ($SimpMutasi as $s)
                                <tr>
                                    <td>{{ $s->tanggal }}</td>
                                    <td>{{ $s->no_bukti }}</td>
                                    <td>{{ $s->keterangan }}</td>
                                    <td align="right">{{ number_format($s->debet,2) }}</td>
                                    <td align="right">{{ number_format($s->kredit,2) }}</td>
                                    {{--  <td></td>  --}}
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" align="center"> <b>T O T A L</b></td>                            
                                <td align="right"><b>{{ number_format($JmlDebet,2) }}</b></td>
                                <td align="right"><b>{{ number_format($JmlKredit,2) }}</b></td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6"><p align="center">Tidak ada mutasi</p></td>
                            </tr>
                        @endif
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
