{{--  @extends('layouts_anggota.app')
@section('content-app')  --}}
@include('message.flash')
<link href="{{ asset('public/landing/assets') }}/vendor/aos/aos.css" rel="stylesheet">
<link href="{{ asset('public/landing/assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('public/landing/assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('public/landing/assets') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="{{ asset('public/landing/assets') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/landing') }}/css/style.css">
<div class="row row-cards row-deck">
    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-3 g-3">
            @foreach ($Produk as $p)
                <div class="col hp">
                    <div class="card h-100 shadow-sm">

                        <a href="{{ url('/detail/' . $p->id) }}">
                            <img src="{{ asset('public/images') }}/{{ $p->foto }}" class="card-img-top"
                                alt="product.title" />
                        </a>
                        {{--  <div class="label-top shadow">
                            <a href="{{ route('add.to.cart', $p->id) }}" title="Tambah Keranjang" class="text-white">
                                <i class="fa fa-fw fa-cart-shopping"></i></a>
                        </div>  --}}
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <span class="float-start badge rounded-pill bg-info">Rp
                                    {{ number_format($p->harga_jual, 2) }}</span>

                                @if ($p->cicilan == 'Y')
                                    <p><small class="float-start"><a class="small text-muted text-small">Cicilan 12x Rp.
                                                {{ number_format($p->harga_jual / 12, 2) }} / bulan</a></small></p>
                                @endif
                            </div>
                            <h5 class="card-title font-weight-reguler">
                                <a href="{{ url('/detail/' . $p->id) }}">{{ $p->nama_barang }}</a>
                            </h5>

                            <div class="d-grid gap-2 my-2">

                                <a href="{{ route('add.to.cart', $p->id) }}"
                                    class="btn btn-primary bold-btn btn-xs"><i class="fa fa-fw fa-cart-plus"></i> Masukkan Keranjang</a>



                                {{--  <a href="{{ route('add.to.cart', $p->id) }}" class="btn btn-primary bold-btn">Tambah Keranjang</a>  --}}

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $Produk->links() }}
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
                <form action="{{ url('admin/master_akun/hapus') }}" method="POST">
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
{{--  @endsection  --}}
