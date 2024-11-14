@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pembagian SHU</h3>
                <div class="card-options">
                    
                </div>
            </div>
            <div class="card-body">
                <h3>Porsi Pembagian SHU</h3>
                <table class="table table-striped table-bordered" width="50%" >
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th width="20px">Prosentase (%)</th>
                        </tr>
                    </thead>                    
                    <tbody>
                    @foreach ($ItemShu as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->persen }} %</td>
                        </tr>    
                    
                    @endforeach
                </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
