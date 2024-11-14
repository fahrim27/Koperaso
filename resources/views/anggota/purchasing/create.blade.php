@extends('layouts_anggota.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengajuan Pesanan</h3>
                <blockquote class="blockquote">
                    <h4>{{ $NamaAgt }}</h4>
                    <h5>{{ $Perush }}</h5>
                </blockquote>  
            </div>
            <div class="card-body">
                <h3>Informasi Barang</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-people mt-auto">
                            <img src="{{ asset('public/images') }}/{{ $Produk->foto }}" alt="people">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table id="#" class="table table-striped table-hover" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="20%">Kategori</td>
                                    <td>:</td>
                                    <td>{{  $Produk->Kategori->kategori }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Nama Barang</td>
                                    <td width="5%">:</td>
                                    <td>{{  $Produk->nama_barang }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Harga Barang</td>
                                    <td width="5%">:</td>
                                    <td> Rp. {{  number_format($Produk->harga_jual) }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Status</td>
                                    <td width="5%">:</td>
                                    <td> {{ $Produk->status }}<td>
                                </tr>
                                <tr>
                                    <td width="20%">Deskripsi</td>
                                    <td width="5%">:</td>
                                    <td><blockquote>
                                        {{ $Produk->deskripsi }}</blockquote><td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div> 
                </div> 
                <br>
                <h3>Detail Pesanan</h3>
                <form action="{{url('anggota/purchasing/addnew')}}" method="post">
                    <input type="hidden" name="id_anggota" value="{{ $IdAnggota }}">
                    <input type="hidden" name="id_pinjaman" value="{{ $IdPinjaman }}">
                    <input type="hidden" name="id_barang" value="{{ $Produk->id }}">
                    <input type="hidden" name="harga" value="{{ $Produk->harga_jual }}">
                    <input type="hidden" name="namabarang" value="{{ $Produk->nama_barang }}">

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nominal Pesanan </label>                            
                            <input type="text" min="0" name="jumlah" class="form-control" id="nominal" value={{ number_format($Produk->harga_jual) }} disabled >                            
                        </div>
                        <div class="col-md-6">
                            <label>Pembayaran </label>
                            <div class="row">
                                @if ($Produk->bayar_penuh=='Y')
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="pembayaran" id="kas_masuk" value="bayarpenuh" data-description="" checked>
                                            Bayar Penuh
                                        </label>
                                        </div>
                                    </div>
                                @endif
                                @if ($Produk->cicilan=='Y')
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="pembayaran" id="kas_keluar" value="cicilan"  data-description="Cicilan 12x Rp. {{ number_format(($Produk->harga_jual/12),2) }}" >
                                            Cicilan
                                        </label>
                                        </div>
                                    </div>
                                @endif  
                            </div>
                            <label class="changename text-muted"><i>&nbsp;</i></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Jumlah Barang</label>
                            <input type="number" name="qty" min=1 value=1 class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label class="form-label">Catatan</label>
                            <input type="text" name="notes" class="form-control">
                        </div>
                    </div>
                    <br>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                              </div>
                          </div>
                    </div>  
                </div> 
            </form>
            
        </div>
    </div>
</div>
@endsection
