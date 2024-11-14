@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Import Transaksi Simpanan</h3>
                <div class="card-options">
                    <a target="_blank" href="{{ url('/admin/simp_mutasi/download_excel') }}" class="btn btn-sm btn-pill btn-primary">Download Excel</a>
                    <a href="#modalimport" data-toggle="modal" data-placement="top" title="Hapus" class="btn btn-sm btn-pill btn-primary">Import Excel</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tanggal</th>
                            <th>No. Transaksi</th>
                            <th>Nama Anggota</th>
                            <th>Nama Simpanan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Keterangan</th>                            
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{url('admin/simp_mutasi/import')}}" method="POST" enctype="multipart/form-data">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Import Transaksi Simpanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{ csrf_field() }}
 
            <label>Pilih file excel</label>
            <div class="form-group">
                <input type="file" name="file" required="required">
            </div>
        </div>
        <div class="modal-footer">        
            <input type="hidden" id="idhapus" name="id" value="">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-primary" value="Import">
         
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
</form>
    <!-- /.modal-dialog -->
  </div>
@endsection
