@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Rekening Pinjaman</h3>
                <div class="card-options">
                    <blockquote class="blockquote">
                        <h4>{{ $PbyRekening->Anggota->nama_anggota }}</h4>
                        <h5>{{ $PbyRekening->Anggota->Department->nama }}  -  {{ $PbyRekening->Anggota->Perusahaan->nama }}</h5>
                        <h5>{{  $PbyRekening->PbyMaster->nama }}</h5>
                        <h5>Jumlah Pinjaman : Rp. {{  number_format($PbyRekening->plafond,2) }} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;   {{ $PbyRekening->jangka }} Bulan</h5>
                        <h5>Sisa Pinjaman : Rp. {{  number_format($PbyRekening->saldo_akhir,2) }}</h5>                        
                    </blockquote>  
                </div>
            </div>
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Angsuran Pinjaman</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Riwayat Angsuran</a>
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Jadwal Angsuran</a>
                    </div>
                </nav>
                  <div class="tab-content" id="nav-tabContent">
                     {{----  Angsuran  -----}}
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="{{  url('admin/pby_angsuran/addnew') }}" method="POST">
                            <ul class="nav profile-navbar">
                            <li class="nav-item">
                                <a class="nav-link active">
                                    <i class="ti-receipt"></i>
                                    Angsuran Ke- {{ $PbyRekening->angske }}
                                </a>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Angsuran Pokok </label>
                                    @if ($errors->any('ang_pokok'))
                                       <div class="form-group input-group has-error">
                                    @else
                                       <div class="form-group input-group">
                                    @endif
                                        <input type="text" min="0" name="ang_pokok" class="form-control" id="nominal" value="{{ $NomPokok }}">
                                       <span class="help-block">{{$errors->first('ang_pokok')}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Angsuran Jasa </label>
                                    @if ($errors->any('ang_jasa'))
                                       <div class="form-group input-group has-error">
                                    @else
                                       <div class="form-group input-group">
                                    @endif
                                        <input type="text" min="0" name="ang_jasa" class="form-control" id="nominal2" value="{{ $NomJasa }}">
                                       <span class="help-block">{{$errors->first('ang_jasa')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Keterangan</label>
                                    @if ($errors->any('keterangan'))
                                        <div class="form-group input-group has-error">
                                    @else
                                        <div class="form-group input-group">
                                    @endif                                        
                                        <input type="text" name="keterangan"class="form-control" >
                                        <span class="help-block">{{$errors->first('keterangan')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>   Kembali</a>
                                        <input type="hidden" name="id_norek" value="{{$PbyRekening->id}}">
                                        <input type="hidden" name="idpinjaman" value="{{$PbyRekening->id_pinjaman}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>  Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>                   
                                    <th>Tanggal</th>
                                    <th>No Transaksi</th>
                                    <th>Angsuran Pokok</th>
                                    <th>Angsuran Jasa</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($PbyMutasi as $m)
                                <tr>
                                    <td  width="2%">
                                        <a href="{{ url('admin/pby_rekening/detail/cetak/'.$m->id) }}" data-toggle="tooltip" data-placement="top" title="Cetak Bukti Transaksi"><i class="fa fa-fw fa-print"></i></a>
                                        
                                        <a href="#modelhapus" onclick="$('#idhapus').val({{$m->id}})" data-toggle="modal" data-placement="top"  title="Hapus">
                                            <i class="fa fa-fw fa-trash" style="color:red"></i></a>
                                    </td>
                                    <td width="6%" align="center">{{ $m->tanggal }}</td>
                                    <td width="6%">{{ $m->no_bukti }}</td>                      
                                    <td align="right">{{ number_format($m->angs_pokok,2) }}</td>
                                    <td align="right">{{ number_format($m->angs_jasa,2) }}</td>
                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table id="tabel-data-2" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="3%">Angs Ke- </th>
                                    <th>Tanggal</th>
                                    <th>Tagihan Pokok</th>
                                    <th>Tagihan Jasa</th>
                                    <th>Jumlah Tagihan</th>
                                    <th width="5%">Status</th>                      
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($JdwAngs as $j)
                                <tr>
                                    <td align="center">{{ $j->angske }}</td>
                                    <td align="center">{{ $j->tanggal }}</td>                      
                                    <td align="right">{{ number_format($j->tag_pokok,2) }}</td>
                                    <td align="right">{{ number_format($j->tag_jasa,2) }}</td>
                                    <td align="right">{{ number_format($j->tag_pokok+$j->tag_jasa,2) }}</td>
                                    <td>
                                        @if ($j->status == "OK")
                                            <div class="badge badge-success">Lunas</div>
                                        @else
                                            <div class="badge badge-warning">Menunggu Pembayaran</div>
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
          <form action="{{url('admin/pby_mutasi/delete')}}" method="POST">
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
