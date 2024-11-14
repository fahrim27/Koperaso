@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data User</h3>
                    <div class="card-options">
                        <a href="{{ url('/admin/master_user/addnew') }}" class="btn btn-sm btn-pill btn-primary">Tambah
                            User</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10%">Nama Lengkap</th>
                                <th>Email</th>
                                <th>Role Akses</th>
                                <th>Department</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($User as $p)
                                <tr>
                                    <td>
                                        {{ $p->name }}
                                    </td>
                                    <td>
                                        {{ $p->email }}
                                    </td>
                                    <td>
                                        {{ $p->role }}
                                    </td>
                                    <td>
                                        @switch($p->department)
                                            @case('CFO')
                                                CFO
                                            @break
                                            @case('HR')
                                                HRD
                                            @break
                                            @case('ADMIN')
                                                Administrator
                                            @break
                                            @case('USP')
                                                Unit Simpan Pinjam
                                            @break
                                            @case('UJB')
                                                Unit Jual Beli
                                            @break
                                            @default
                                              -
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="pull-right">
                                            <a href="{{ url('admin/master_user/edit/' . $p->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="Edit">
                                                <i class="fa fa-fw fa-edit"></i></a>
                                            <a href="#modelhapus" onclick="$('#idhapus').val({{ $p->id }})"
                                                data-toggle="modal" data-placement="top" title="Hapus">
                                                <i class="fa fa-fw fa-trash"></i></a>
                                        </div>
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
                    <h5 class="modal-title" id="myModalLabel">Hapus User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah user tersebut akan dihapus ?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/master_user/hapus') }}" method="POST">
                        <input type="hidden" id="idhapus" name="id" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
