@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Produk</h3>
                <div class="card-options">

                </div>
            </div>
            <form action="{{url('admin/master_produk/update')}}" method="POST" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  @if ($errors->any('id_kategori'))
                      <div class="form-group has-error">
                  @else
                      <div class="form-group">
                  @endif
                  <label class="changename">Kategori Barang</label>
                  <select class="js-example-basic-single w-100" name="id_kategori" id="single" autofocus>
                      <option value="">-- Pilih Kategori--</option>
                      @foreach ($Kategori as $k)
                          <option value="{{ $k->id }}"
                            @if ($Produk->id_kategori == $k->id)
                                selected='selected'                                
                            @endif>
                              {{ $k->kategori }}
                          </option>
                      @endforeach
                    </select>
                    <span class="help-block">{{$errors->first('id_kategori')}}</span>
                    </div>
                </div>                
              </div>

              <div class="row">
                <div class="col-md-12">
                  @if ($errors->any('nama'))
                      <div class="form-group has-error">
                  @else
                      <div class="form-group">
                  @endif
                      <label class="form-label">Nama Barang</label>
                      <input type="text" name="nama" class="form-control" value="{{ $Produk->nama_barang }}">
                      <span class="help-block">{{ $errors->first('nama') }}</span>                        
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  @if ($errors->any('deskripsi'))
                      <div class="form-group has-error">
                  @else
                      <div class="form-group">
                  @endif
                      <label class="form-label">Deskripsi</label>
                      <textarea rows="2" class="form-control" name="deskripsi">
                        {{ trim($Produk->deskripsi,"")}}                        
                      </textarea>
                      <span class="help-block">{{ $errors->first('deskripsi') }}</span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">                  
                  @if ($errors->any('harga_beli'))
                      <div class="form-group has-error">
                  @else
                      <div class="form-group">
                  @endif
                      <label>Harga Beli </label>
                      <input type="text" min="0" name="harga_beli" class="form-control" id="nominal2" value={{ $Produk->harga_beli }}>
                      <span class="help-block">{{$errors->first('harga_beli')}}</span>
                  </div>
                </div>
                <div class="col-md-6">                  
                  @if ($errors->any('harga'))
                      <div class="form-group has-error">
                  @else
                      <div class="form-group">
                  @endif
                      <label>Harga Jual </label>
                      <input type="text" min="0" name="harga" class="form-control" id="nominal" value={{ $Produk->harga_jual }}>
                      <span class="help-block">{{$errors->first('harga')}}</span>
                  </div>
                </div>                
              </div>

              <div class="row">                
                <div class="col-md-6">
                  @if ($errors->any('status'))
                      <div class="form-group has-error">
                  @else
                      <div class="form-group">
                  @endif
                  <label class="changename">Status Barang</label>
                  <select class="js-example-basic-single w-100" name="status" id="single2">
                    <option value="">-- Pilih Status --</option>
                    <option value="PreOrder" {{ $Produk->status == "PreOrder" ? 'selected' : '' }}>PreOrder</option>
                    <option value="Ready Stock" {{ $Produk->status == "Ready Stock" ? 'selected' : '' }}>Ready Stock</option>
                    <option value="Out of Stock" {{ $Produk->status == "Out of Stock" ? 'selected' : '' }}>Out of Stock</option>
                    <option value="Discontinue" {{ $Produk->status == "Discontinue" ? 'selected' : '' }}>Discontinue</option>
                </select>
                    <span class="help-block">{{$errors->first('status')}}</span>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Estimasi PreOrder</label>
                    <div class="input-group">                                       
                      <input type="number" min="0" name="estimasi" class="form-control" value={{ $Produk->estimasi }}>  
                      <div class="input-group-append">
                        <span class="input-group-text">Hari</span>
                      </div>     
                    </div>               
                  </div>
                </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Foto Barang</label>
                          <input type="file" name="filename" class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Stok Barang</label>
                        <input type="number" min="0" name="stok" value="{{ $Produk->stok }}" class="form-control" >                      
                    </div>
                  </div>
              </div>
              {{--  <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">                    
                          <input type="checkbox" class="form-check-input" name="is_cicilan" {{ $Produk->cicilan=="Y" ? 'checked' : '' }}> Skema Cicilan
                        </label>
                    </div>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">                    
                          <input type="checkbox" class="form-check-input" name="is_bayarpenuh" {{ $Produk->bayar_penuh=="Y" ? 'checked' : '' }}> Bayar Penuh
                        </label>
                    </div>
                  </div>
                </div>
              </div>  --}}
              <div class="row">
                  <div class="col-sm-12">
                      <div class="pull-right">
                          <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <input type="hidden" name="id" value="{{ $Produk->id }}">
                          <input type="hidden" name="foto" value="{{ $Produk->foto }}">

                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modelhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Hapus Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah akun tersebut akan dihapus ?
        </div>
        <div class="modal-footer">
          <form action="{{url('admin/master_akun/hapus')}}" method="POST">
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
