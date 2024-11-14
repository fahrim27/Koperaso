@extends('layouts.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pengajuan Pinjaman</h3>
                <div class="card-options">
                    <blockquote class="blockquote">
                        <h4>{{ $PbyPengajuan->Anggota->nama_anggota }}</h4>
                        <h5>{{ $PbyPengajuan->Anggota->Department->nama }}  -  {{ $PbyPengajuan->Anggota->Perusahaan->nama }}</h5>
                        <h4>{{ $PbyPengajuan->Anggota->status_karyawan }}</h4>
                    </blockquote>  
                </div>
            </div>
            <div class="card-body">
                <table id="#" class="table table-striped table-hover" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="20%">No. Pengajuan</td>
                            <td>:</td>
                            <td>{{  $PbyPengajuan->no_pengajuan }}<td>
                        </tr>
                        <tr>
                            <td width="20%">Tanggal Pengajuan</td>
                            <td width="5%">:</td>
                            <td>
                              {{ \Carbon\Carbon::parse($PbyPengajuan->tanggal)->translatedFormat('d F Y') }}<td>
                        </tr>
                        <tr>
                            <td width="20%">Nominal Pengajuan</td>
                            <td width="5%">:</td>
                            <td> Rp. {{  number_format($PbyPengajuan->nominal,2) }}<td>
                        </tr>
                        <tr>
                            <td width="20%">Jangka Waktu</td>
                            <td width="5%">:</td>
                            <td>{{  $PbyPengajuan->jangka }} Bulan<td>
                        </tr>
                        <tr>
                            <td width="20%">Jaminan</td>
                            <td width="5%">:</td>
                            <td>{{ $PbyPengajuan->jaminan }}<td>
                        </tr>
                        <tr>
                            <td width="20%">Keperluan Pinjaman</td>
                            <td width="5%">:</td>
                            <td>{{ $PbyPengajuan->keperluan }}<td>
                        </tr>
                        <tr>
                            <td width="20%">Status Pengajuan</td>
                            <td width="5%">:</td>
                            <td>{{ $PbyPengajuan->status_pengajuan }}<td>
                        </tr>
                        <tr>
                          <td width="20%">Keterangan Tidak Disetujui</td>
                            <td width="5%">:</td>
                            <td>{{ $PbyPengajuan->keterangan }}<td>
                        </tr>                        
                    </tbody>                        
                </table>
                <br>
                @if ($DetailOrder<>[])
                  
                
                <div class="table-responsive w-100">
                  <table class="table">
                      <thead>
                          <tr class="bg-dark text-white">
                              <th>Nama Barang</th>
                              <th class="text-right">Harga</th>
                              <th class="text-right">Jml Barang</th>
                              <th class="text-right">Total</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php $total = 0 @endphp

                          @foreach ($DetailOrder as $p)
                              @php $total += $p->harga * $p->qty @endphp
                              <tr class="text-right">
                                  <td class="text-left">{{ $p->MsProduk->nama_barang }}</td>
                                  <td>Rp {{ number_format($p->harga) }}</td>
                                  <td>{{ $p->qty }}</td>
                                  <td>Rp {{ number_format($p->harga * $p->qty) }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="4" class="text-right">
                                  <h3><strong>Total &nbsp;&nbsp;&nbsp; Rp {{ number_format($total) }}</strong>
                                  </h3>
                              </td>
                          </tr>
                      </tfoot>
                  </table>
              </div>
              @endif
              <form action="{{ url('admin/pencairan/proses') }}" method="POST">
              @if ($PbyPengajuan->status_pengajuan == "Menunggu Pencairan")
                <form action="{{ url('admin/pencairan/proses') }}" method="POST">
                <div class="form-group col-md-6">                    
                  <label>Akun Pencairan Pinjaman</label>
                  <select class="js-example-basic-single w-100" name="akun_kas" id="single" autofocus>
                  <option value="">-- Pilih Akun --</option>
                  @foreach ($Akun as $k)
                      <option value="{{ $k->kde_akun }}" {{ $k->kde_akun == $AkunKas ? "selected" : "" }}>
                          @if ($k->pos_akun == 1)
                              <b>{{ $k->nma_akun }}</b>
                          @else
                              &nbsp;&nbsp;{{ $k->nma_akun }}
                          @endif
                      </option>
                  @endforeach
                  </select>
                </div>
              @endif
              <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                            @switch($PbyPengajuan->status_pengajuan)
                              @case('Menunggu Persetujuan HR')
                                <a href="#modaltolak" onclick="$('#idtolak').val({{$PbyPengajuan->id}})" data-toggle="modal" data-placement="top" class="btn btn-warning btn-sm" title="Tolak Pengajuan"><i class="fa fa-fw fa-close"></i> Tolak Pengajuan</a>

                                <a href="#modalsetuju" onclick="$('#idsetuju').val({{$PbyPengajuan->id}})" data-toggle="modal" data-placement="top" class="btn btn-success btn-sm" title="Setujui Pengajuan"><i class="fa fa-fw fa-check"></i> Disetujui HR</a>
                                @break

                              @case('Menunggu Persetujuan CFO')
                                <a href="#modaltolak" onclick="$('#idtolak').val({{$PbyPengajuan->id}})" data-toggle="modal" data-placement="top" class="btn btn-warning btn-sm" title="Tolak Pengajuan"><i class="fa fa-fw fa-close"></i> Tolak Pengajuan</a>

                                <a href="#modalsetuju" onclick="$('#idsetuju').val({{$PbyPengajuan->id}})" data-toggle="modal" data-placement="top" class="btn btn-success btn-sm" title="Setujui Pengajuan"><i class="fa fa-fw fa-check"></i> Disetujui CFO</a>
                                @break
                              @case('Menunggu Pencairan')
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-success btn-sm" value="Proses Pencairan">
                                @break
                              @default
                                
                            @endswitch

                          </div>
                      </div>
                </div>  
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <form action="{{url('admin/pengajuan/update')}}" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Tolak Pengajuan Pinjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Alasan Penolakan</label>
            <input type="text" name="keterangan"class="form-control" >
            <span class="help-block">{{$errors->first('keterangan')}}</span>
          </div>
        </div>
        <div class="modal-footer">          
            <input type="hidden" id="idtolak" name="id" value="">
            <input type="hidden" name="sts_pengajuan" value="Ditolak">
            <input type="hidden" name="sts_hr" value="Ditolak HR">
            <input type="hidden" name="sts_cfo" value="Ditolak CFO">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-danger" value="Tolak Pengajuan">
          
        </div>
      </div>
    </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modalsetuju" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Setujui Pengajuan Pinjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah pengajuan pinjaman tersebut akan disetujui ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/pengajuan/update')}}" method="POST">
            <input type="hidden" id="idsetuju" name="id" value="">
            <input type="hidden" name="sts_pengajuan" value="Disetujui">
            <input type="hidden" name="sts_hr" value="Disetujui HR">
            <input type="hidden" name="sts_cfo" value="Disetujui CFO">


            <input type="hidden" name="keterangan" value="">

            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-success" value="Setujui Pengajuan">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  
@endsection
