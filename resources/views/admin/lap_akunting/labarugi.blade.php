@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Laba Rugi</h3>
                <div class="card-options">
                    <form action="{{url('admin/lap_akunting/labarugi')}}" method="POST">
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
                                <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/labarugi')}}"><i class="fa fa-table"></i> Tampilkan</button>
                                <button type="submit" class="btn btn-primary btn-sm" formaction="{{url('admin/lap_akunting/labarugi/cetak')}}" formtarget="_blank"><i class="fa fa-print"></i> Cetak Laba Rugi</button>
                            </div>
                          </div>
                        </div>
                      </form> 
                </div>
            </div>
            <div class="card-body">
                @if ($Pendptan <> [])
                    <table id="#" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Akun</th>
                                <th>Nama Akun</th>
                                <th>Saldo Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Pendptan as $k)
                                <tr>
                                    <td>
                                        {{ $k->kde_akun }}
                                    </td>
                                    <td>
                                        @if ($k->pos_akun == 1)
                                            {{ $k->nma_akun }}
                                        @else
                                            &nbsp;&nbsp;{{ $k->nma_akun }}
                                        @endif
                                    </td>
                                    <td align="right">{{ number_format($k->saldo_akhir,2) }}</td>
                                </tr>                                
                            @endforeach
                            <tr>
                                <td colspan="2" align="center" class="font-weight-bold">
                                    TOTAL PENDAPATAN
                                </td>
                                <td align="right" class="font-weight-bold">
                                    {{ number_format($JmlPendpt,2) }}
                                </td>
                            </tr>
                            @foreach ($Biaya as $b)
                            <tr>
                                <td>
                                    {{ $b->kde_akun }}
                                </td>
                                <td>
                                    @if ($b->pos_akun == 1)
                                        {{ $b->nma_akun }}
                                    @else
                                        &nbsp;&nbsp;{{ $b->nma_akun }}
                                    @endif
                                </td>
                                <td align="right">{{ number_format($b->saldo_akhir,2) }}</td>
                            </tr>  
                            @endforeach
                            <tr>
                                <td colspan="2" align="center" class="font-weight-bold">
                                    TOTAL BIAYA
                                </td>
                                <td align="right" class="font-weight-bold">
                                    {{ number_format($JmlBiaya,2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" class="font-weight-bold">
                                    SISA HASIL USAHA
                                </td>
                                <td align="right" class="font-weight-bold">
                                    {{ number_format($JmlPendpt-$JmlBiaya,2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
