@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Jurnal</h3>
                <div class="card-options">
                    <form method="post">
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
                            <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/lapjurnal/filter')}}"><i class="fa fa-table"></i> Tampilkan</button>
                            <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/lapjurnal/cetak')}}" formtarget="_blank"><i class="fa fa-print"></i> Cetak Jurnal</button>
                          </div>
                        </div>
                      </div>
                    </form>                      
                </div>
            </div>
            <div class="card-body">
                <table id="#" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No Transaksi</th>
                            {{--  <th>Kode Akun</th>  --}}
                            <th>Nama Akun</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Keterangan</th>                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($KasMutasi as $Akt)
                        <tr>
                            <td>
                                {{ $Akt->tanggal }}
                            </td>
                            <td>
                                {{ $Akt->no_bukti }}
                            </td>
                            {{--  <td>
                                {{ $Akt->kde_akun }}
                            </td>  --}}
                            
                            <td>
                                @if ($Akt->pos_akun == 1)
                                    {{ $Akt->nma_akun }}
                                @else
                                    &nbsp;&nbsp;{{ $Akt->nma_akun }}
                                @endif
                            </td>
                            
                            <td align="right">
                                {{ number_format($Akt->debet,2) }}
                            </td>
                            <td align="right">
                                {{ number_format($Akt->kredit,2) }}
                            </td>
                            <td>
                                {{ $Akt->keterangan }}
                            </td>
                            <td>
                                <div class="pull-right">                         
                                    <a href="#modelhapus" onclick="$('#idhapus').val({{$Akt->id}})" data-toggle="modal" data-placement="top"  title="Hapus Akun">
                                        <i class="fa fa-fw fa-trash" style="color:red"></i></a></div>
                              </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
