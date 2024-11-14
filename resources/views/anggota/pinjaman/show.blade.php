@extends('layouts_anggota.app')
@section('content-app')
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
                      <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Riwayat Angsuran</a>
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Jadwal Angsuran</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No Transaksi</th>
                                    <th>Angsuran Pokok</th>
                                    <th>Angsuran Jasa</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($PbyMutasi as $m)
                                <tr>
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
                                    <th>Nominal Pokok</th>
                                    <th>Nominal Jasa</th>
                                    <th>Jml Angsuran</th>
                                    <th width="5%">Status</th>                      
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($JdwAngs as $j)
                                <tr>
                                    <td align="center">{{ $j->angske }}</td>
                                    <td align="center">{{ $j->tanggal }}</td>                      
                                    <td align="right">{{ number_format($j->angs_pokok,2) }}</td>
                                    <td align="right">{{ number_format($j->angs_jasa,2) }}</td>
                                    <td align="right">{{ number_format($j->angs_pokok+$j->angs_jasa,2) }}</td>
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
<div class="modal fade" id="modaltolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Tolak Pengajuan Pinjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah pengajuan pinjaman tersebut akan ditolak ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/pengajuan/update')}}" method="POST">
            <input type="hidden" id="idtolak" name="id" value="">
            <input type="hidden" name="sts_pengajuan" value="Ditolak">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-danger" value="Tolak Pengajuan">
          </form>
        </div>
      </div>
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
          Apakah pengajuan pinjaman tersebut akan distujui ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/pengajuan/update')}}" method="POST">
            <input type="hidden" id="idsetuju" name="id" value="">
            <input type="hidden" name="sts_pengajuan" value="Disetujui">
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
