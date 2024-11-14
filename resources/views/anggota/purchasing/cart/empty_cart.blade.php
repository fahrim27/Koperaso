@extends('layouts_anggota.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Keranjang Belanja</h3>
                </div>
                <div class="card-body">
                    <div class="card-body text-center">
                        <div class="">
                            <img src="{{ url('') }}/public/images/empty-cart.png" alt="keranjang kosong" width="275px"
                                height="275px" />
                            <h4>Keranjang belanja Anda masih kosong</h4>
                        </div>
                        <a href="{{ url('anggota/purchasing/catalog') }}" class="btn btn-primary btn-sm mt-3 mb-4">Lanjutkan
                            Belanja</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Hapus Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah barang tersebut akan dihapus dari keranjang belanja ?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('remove.from.cart') }}" method="POST">
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
