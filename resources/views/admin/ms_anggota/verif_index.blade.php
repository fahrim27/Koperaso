@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Permohonan Anggota</h3>
                <div class="card-options">
                  {{--  <form action="{{url('admin/master_anggota/filter')}}" method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Filter Perusahaan</label>
                          <select class="js-example-basic-single w-100" name="idperush" id="single" autofocus>
                              <option value="">-- Pilih Perusahaan --</option>
                              @foreach ($Perush as $p)
                                  <option value="{{ $p->id }}">{{ $p->nama }}</option>
                              @endforeach
                          </select>
                        </div>                          
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-table"></i> Tampilkan</button>
                        </div>
                      </div>
                    </div>
                  </form>                        --}}
              </div>
                {{--  <div class="card-options">
                    <a href="{{ url('/admin/master_anggota/addnew') }}" class="btn btn-sm btn-pill btn-primary">Tambah Anggota</a>
                </div>  --}}
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Anggota</th>
                            <th>NIK</th>
                            <th>Nama Anggota</th>
                            <th>Perusahaan</th>
                            {{--  <th>Jabatan</th>  --}}
                            <th>Status Karyawan</th>
                            <th>Status Keanggotaan</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Anggota as $Agt)
                        <tr>
                            <td>
                              {{ $Agt->no_anggota }}
                            </td>
                            <td>
                              {{ $Agt->nik }}
                            </td>
                            <td>
                              {{ $Agt->nama_anggota }}
                            </td>
                            <td>
                              {{ $Agt->Perusahaan->nama }}
                            </td>
                            <td>
                              {{ $Agt->status_karyawan }}
                            </td>
                            <td>
                              {{ $Agt->status_keanggotaan }}
                            </td>

                            <td>
                                {{--  <div class="pull-right">  --}}
                                  @if (($Agt->status_keanggotaan == "Menunggu") &&((userHelpers('department')=='HR') || (userHelpers('department')=='ADMIN')))
                                    <a href="#modalverif" onclick="$('#idagt').val({{$Agt->id}})" data-toggle="modal" data-placement="top" title="Verifikasi">
                                      <i class="fa fa-fw fa-check-circle" style="color:green"></i></a> 
                                  @endif

                                  <a href="{{ url('admin/master_anggota/detail/'.$Agt->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa fa-fw fa-info-circle"></i></a>                                

                                  <a href="{{ url('admin/master_anggota/edit/'.$Agt->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa fa-fw fa-edit"></i></a>

                                  <a href="#modelhapus" onclick="$('#idhapus').val({{$Agt->id}})" data-toggle="modal" data-placement="top"  title="Hapus">
                                  <i class="fa fa-fw fa-trash"></i></a>
                                {{--  </div>  --}}
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
          <h5 class="modal-title" id="myModalLabel">Hapus Anggota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah anggota tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/master_anggota/hapus')}}" method="POST">
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
