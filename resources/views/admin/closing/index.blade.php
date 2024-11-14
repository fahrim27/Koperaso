@extends('layouts.app')
@section('content-app')
@include('message.flash')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Closing Periode</h3>
                <div class="card-options">
                    <p>Untuk melakukan proses closing periode, pastikan semua transaksi pada periode saat ini sudah selesai semua.</p>
                </div>
            </div>
            <div class="card-body">
                {{--  <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Periode Saat Ini</label>
                        <input type="text" name="periode" class="form-control" value="{{ periodeTagihan('periode_tag') }}" disabled>
                    </div>
                </div>  --}}
                <table id="#" class="table table-striped table-hover" width="100%" cellspacing="0">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td width="20%">Periode Saat Ini</td>
                            <td width="2%">:</td>
                            <td align="left">{{ periodeTagihan('periode_tag') }}<td>
                        </tr>
                        <tr>
                            <td width="20%">SHU Bulan Ini</td>
                            <td width="2%">:</td>
                            <td align="left">Rp. {{ number_format($Shu,2) }}<td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr rowspan="3">
                            <td>
                                <a href="{{ url('/admin/closing/proses') }}" class="btn btn-sm btn-pill btn-primary"> <i class="fa fa-save fa-fw"></i> Proses Closing</a>
                            </td>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
