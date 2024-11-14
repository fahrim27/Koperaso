@extends('layouts.app')
@section('content-app')
@include('message.flash')

<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Verifikasi Setoran Anggota</h3>                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-people mt-auto">
                            <img src="{{ asset('public/images') }}/{{ $AgtTrx->lampiran }}" alt="people">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table id="#" class="table table-striped table-hover" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="20%">No. Anggota</td>
                                    <td width="5%">:</td>
                                    <td align="left">{{  $AgtTrx->Anggota->no_anggota }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Nama Anggota</td>
                                    <td width="5%">:</td>
                                    <td align="left">{{  $AgtTrx->Anggota->nama_anggota }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Perusahaan</td>
                                    <td>:</td>
                                    <td>{{  $AgtTrx->Anggota->Perusahaan->nama }} - {{  $AgtTrx->Anggota->Department->nama }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Tanggal Transaksi</td>
                                    <td>:</td>
                                    <td>{{ 
                                        \Carbon\Carbon::parse($AgtTrx->tanggal)->translatedFormat('d F Y') }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Jenis Simpanan</td>
                                    <td>:</td>
                                    <td>{{  $AgtTrx->SimpRekening->SimpMaster->nama }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Nominal</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($AgtTrx->nominal,2) }}<td>
                                </tr>
                            <tbody>
                        </table>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                    <a href="#modalverif" onclick="$('#idverif').val({{$AgtTrx->id}})" data-toggle="modal" data-placement="top" class="btn btn-success btn-sm" title="Verifikasi Setoran"><i class="fa fa-fw fa-check"></i> Verifikasi Setoran</a>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalverif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Verifikasi Setoran Anggota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah setoran simpanan tersebut akan diverifikasi ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/simp_verifikasi/proses')}}" method="POST">
            <input type="hidden" id="idverif" name="id" value="">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-success" value="Verifikasi Setoran">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
