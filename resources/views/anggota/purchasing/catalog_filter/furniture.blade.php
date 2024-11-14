@extends('layouts_anggota.app')
@section('content-app')
    <div class="row row-cards row-deck">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/anggota/purchasing/catalog') }}">Semua Kategori</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('anggota/purchasing/catalog/bahan_pokok') }}">Bahan Pokok</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('anggota/purchasing/catalog/elektronik') }}">Elektronik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('anggota/purchasing/catalog/furniture') }}">Furniture</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('anggota/purchasing/catalog/sepeda_motor') }}">Sepeda Motor</a>
            </li>
        </ul>        
</div><p></p>
<div class="row">
    <form action="{{ url('anggota/purchasing/catalog/furniture/cari') }}" method="GET">                
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari produk" aria-label="Cari produk" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </div>
    </form>
    
</div>
@include('anggota.purchasing.catalog')
@endsection
