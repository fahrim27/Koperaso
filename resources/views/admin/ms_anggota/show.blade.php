@extends('layouts.app')
@section('content-app')
@include('message.flash')

<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Anggota</h3>                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-people mt-auto">
                            <img src="{{ asset('public/images') }}/{{ $MsAnggota->foto_ktp }}" alt="people">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table id="#" class="table table-striped table-hover" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="20%">NIK (ID Karyawan)</td>
                                    <td width="5%">:</td>
                                    <td align="left">{{  $MsAnggota->nik }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Nama Anggota</td>
                                    <td width="5%">:</td>
                                    <td align="left">{{  $MsAnggota->nama_anggota }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Perusahaan</td>
                                    <td>:</td>
                                    <td>{{  $MsAnggota->Perusahaan->nama }} - {{  $MsAnggota->Department->nama }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Status Karyawan</td>
                                    <td>:</td>
                                    <td>{{  $MsAnggota->status_karyawan }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{  $MsAnggota->jenis_kelamin }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Tempat, Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>
                                        {{  $MsAnggota->tempat_lahir }}, {{ 
                                        \Carbon\Carbon::parse($MsAnggota->tgl_lahir)->translatedFormat('d F Y') }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Email</td>
                                    <td>:</td>
                                    <td>{{  $MsAnggota->email }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">No. Telp</td>
                                    <td>:</td>
                                    <td>{{  $MsAnggota->no_telpon }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Alamat</td>
                                    <td>:</td>
                                    <td>{{  $MsAnggota->alamat }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Alamat Domisili</td>
                                    <td>:</td>
                                    <td>{{  $MsAnggota->alamat_domisili }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">No. Rekening BCA</td>
                                    <td>:</td>
                                    <td>{{  $MsAnggota->no_rekening }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Simpanan Pokok</td>
                                    <td>:</td>
                                    <td>Rp {{  number_format($MsAnggota->Jabatan->simp_pokok) }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Simpanan Wajib</td>
                                    <td>:</td>
                                    <td>Rp {{  number_format($MsAnggota->Jabatan->simp_wajib) }}<td>
                                </tr>
                            <tbody>
                        </table>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                    @if ($MsAnggota->status_keanggotaan == "Menunggu")
                                    <a href="#modalverif" onclick="$('#idagt').val({{$MsAnggota->id}})" data-toggle="modal" data-placement="top" title="Verifikasi" class="btn btn-success btn-sm" ><i class="fa fa-fw fa-check"></i> Verifikasi Anggota</a>
                                    @endif
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
          <h5 class="modal-title" id="myModalLabel">Verifikasi Pendaftaran Anggota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah anggota tersebut akan diverifikasi ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/master_anggota/verifikasi')}}" method="POST">
            <input type="hidden" id="idagt" name="id" value="">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-primary" value="Verifikasi">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
