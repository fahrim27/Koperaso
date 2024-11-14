@extends('layouts_anggota.app')
@section('content-app')
            <div class="row">
                <div class="col-md-12 grid-margin transparent">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome {{ $NamaAgt }}</h3>                        
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <img src="https://png.pngtree.com/png-vector/20191103/ourlarge/pngtree-handsome-young-guy-avatar-cartoon-style-png-image_1947775.jpg" class="img-lg rounded" alt="profile image"/>
                                    <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <h6 class="mb-0">{{ $NamaAgt }}</h6>
                                        <p class="text-muted mb-1">{{ $Email }}</p>
                                        <p class="mb-0 text-success font-weight-bold">{{ $Department }} - {{ $Perush }}</p>
                                        {{--  <p class="text-secondary">Status Anggota {{ $StsAnggota }}</p>  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin transparent">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">Simpanan</p>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless">
                                            <tbody>
                                                @foreach ($SimpRek as $s )
                                                    <tr>
                                                        <td>{{  $s->SimpMaster->nama }}</td>
                                                        <td>Rp. {{ number_format($s->saldo_akhir,2) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="font-weight-bold" align="center"> TOTAL</td>
                                                    <td class="font-weight-bold">Rp. {{ number_format($JmlSimp,2) }}</td>
                                                </tr>
                                            <tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                        
                        <div class="col-md-6 grid-margin transparent">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">Pinjaman</p>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless">
                                            <tbody>
                                                @foreach ($PbyRek as $p)
                                                    <tr>
                                                        <td>{{  $p->PbyMaster->nama }}</td>
                                                        <td>Rp. {{ number_format($p->saldo_akhir,2) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="font-weight-bold" align="center"> TOTAL</td>
                                                    <td class="font-weight-bold">Rp. {{ number_format($JmlPby,2) }}</td>
                                                </tr>
                                            <tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </div>
        <!-- content-wrapper ends -->
    </div>
@endsection
