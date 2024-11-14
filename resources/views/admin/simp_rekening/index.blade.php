@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Rekening Simpanan</h3>
                    <div class="card-options">
                        <form action="{{ url('admin/simp_rekening/filter') }}" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Filter Simpanan</label>
                                        <select class="js-example-basic-single w-100" name="kdesimp" id="single"
                                            autofocus>
                                            <option value="">-- Pilih Simpanan --</option>
                                            @foreach ($SimpMaster as $s)
                                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-table"></i>
                                            Tampilkan</button>

                                        <a href="{{ url('/admin/simp_rekening/addnew') }}" class="btn btn-primary btn-sm"><i
                                                class="fa fa-file"></i> Buat Rekening Baru</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No. Anggota</th>
                                <th>No. Rekening</th>
                                <th>Nama Anggota</th>
                                <th>Nama Simpanan</th>
                                <th>Nominal Setoran</th>
                                <th>Saldo Simpanan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SimpRek as $Simp)
                                <tr>
                                    <td>
                                        {{ $Simp->Anggota->no_anggota }}
                                    </td>
                                    <td>
                                        {{ $Simp->no_rek }}
                                    </td>
                                    <td>
                                        {{ $Simp->Anggota->nama_anggota }}
                                    </td>
                                    <td>
                                        {{ $Simp->SimpMaster->nama }}
                                    </td>
                                    <td>
                                        Rp {{ number_format($Simp->setoran) }}
                                        @if ($Simp->SimpMaster->nama == 'Simpanan Wajib')
                                            <span class="float-right"><a href="#modeledit" onclick="$('#idhapus').val({{ $Simp->id }})"
                                                data-toggle="modal" data-placement="top"
                                                title="Edit Setoran Simpanan Wajib">
                                                <i class="fa fa-fw fa-edit"></i></a></span> 
                                        @endif
                                    </td>
                                    <td align="right">
                                        Rp {{ number_format($Simp->saldo_akhir, 2) }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/simp_rekening/lihat_mutasi/' . $Simp->id) }}"
                                            data-toggle="tooltip" data-placement="top" title="Lihat Mutasi">
                                            <i class="fa fa-fw fa-info-circle"></i></a>

                                        <a href="#" onclick="$('#idhapus').val({{ $Simp->id }})"
                                            data-toggle="modal" data-placement="top" title="Hapus Akun">
                                            <i class="fa fa-fw fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modeledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Setoran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/simp_rekening/update_setoran') }}" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nominal Setoran</label>
                            <input type="text" min="0" autofocus name="jumlah" class="form-control"
                                id="nominal">
                            <span class="help-block">{{ $errors->first('jumlah') }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idhapus" name="id" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endsection
