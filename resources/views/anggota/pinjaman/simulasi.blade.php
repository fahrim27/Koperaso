@extends('layouts_anggota.app')
@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Simulasi Pinjaman</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{url('anggota/pinjaman/simulasi')}}" method="post">
                        <input type="hidden" name="id_pinjaman" value="{{ $IdPinjaman }}">        
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nominal Pinjaman </label>
                                @if ($errors->any('jumlah'))
                                    <div class="form-group input-group has-error">
                                @else
                                    <div class="form-group input-group">
                                @endif
                                    <input type="text" min="0" name="jumlah" class="form-control" id="nominal" >
                                <span class="help-block">{{$errors->first('jumlah')}}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Jangka Waktu (Bulan) </label>
                                @if ($errors->any('jangka'))
                                    <div class="form-group input-group has-error">
                                @else
                                    <div class="form-group input-group">
                                @endif
                                    <input type="number" min="0" name="jangka" class="form-control" id="nominal" >
                                <span class="help-block">{{$errors->first('jangka')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Lihat Simulasi Pinjaman</button>
                                  </div>
                              </div>
                        </div>  
                    </div> 
                    <br>

                    @if ($DataSimulasi <>[])
                        
                    <table id="tabel-data-2" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="3%">Angs Ke- </th>                                
                                <th>Nominal Pokok</th>
                                <th>Nominal Jasa</th>
                                <th>Jml Angsuran</th>                   
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($DataSimulasi as $j)
                            <tr>
                                <td align="center">{{ $j->angske }}</td>                                
                                <td align="right">{{ number_format($j->angs_pokok,2) }}</td>
                                <td align="right">{{ number_format($j->angs_jasa,2) }}</td>
                                <td align="right">{{ number_format($j->angs_pokok+$j->angs_jasa,2) }}</td>                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>  
                    @else
                    <p></p>
                    @endif             
            </div>
        </div>
    </div>
</div>
@endsection
