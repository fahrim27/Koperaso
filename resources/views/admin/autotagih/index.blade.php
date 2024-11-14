@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Proses Auto Tagih</h3>
                
                <div class="card-option">
                    <form action="{{ url('/admin/autotagih/proses') }}" method="POST">
                        <div class="card-options">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-report"></i> Preview</button>
                            <a href="{{ url('/admin/autotagih/download_excel') }}" 
                            class="btn btn-sm btn-pill btn-primary"><i class="fa fa-file-excel"></i> Download Rekap</a>
                            <a href="{{ url('/admin/autotagih/posting_tagihan') }}" class="btn btn-sm btn-pill btn-primary"> <i class="fa fa-save fa-fw"></i> Posting Tagihan</a>
                        </div>
                        
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </form>
                </div>
            </div>
                <div class="card-body">                    

                    <table id="tabel-data" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th rowspan="2" valign="middle">Nama Anggota</th>
                                <th rowspan="2">Simpanan Pokok</th>
                                <th rowspan="2">Simpanan Wajib</th>
                                <th rowspan="2">Simpanan Sukarela</th>
                                <th colspan="3" align="center">Cicilan Barang</th>
                                <th colspan="3">Pinjaman Tunai</th>
                                <th>TOTAL TAGIHAN</th>
                            </tr>
                            <tr>
                                <th>Nominal</th>
                                <th>Tenor</th>
                                <th>Angs. Ke- </th>
                                <th>Nominal</th>
                                <th>Tenor</th>
                                <th>Angs. Ke- </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Rekap as $Simp)
                                <tr>
                                    <td>
                                        {{ $Simp->Anggota->nama_anggota }}
                                    </td>
                                    <td>
                                        {{ number_format($Simp->simp_pokok,0) }}
                                    </td>
                                    <td>
                                        {{ number_format($Simp->simp_wajib,0) }}
                                    </td>
                                    <td>
                                        {{ number_format($Simp->simp_sukarela,0) }}
                                    </td>
                                    <td>
                                        {{ number_format($Simp->cicilan_barang,0) }}
                                    </td>
                                    <td>{{ number_format($Simp->tenor_cicil,0) }}</td>
                                    <td>{{ number_format($Simp->angske_cicil,0) }}</td>
                                    <td>
                                        {{ number_format($Simp->pinjaman_tunai,0) }}
                                    </td>
                                    <td>{{ number_format($Simp->tenor_tunai,0) }}</td>
                                    <td>{{ number_format($Simp->angske_tunai,0) }}</td>
                                    <td>
                                        {{ number_format($Simp->total_tagihan,0) }}
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr style="font-style: bold">
                                <th>
                                    T O T A L
                                </th>
                                <th>
                                    {{ number_format($TotPokok,0) }}
                                </th>
                                <th>
                                    {{ number_format($TotWajib,0) }}
                                </th>
                                <th>
                                    {{ number_format($TotSuka,0) }}
                                </th>
                                <th>
                                    {{ number_format($Cicilan,0) }}
                                </th>
                                <th></th>
                                <th></th>
                                <th>
                                    {{ number_format($PinjTunai,0) }}
                                </th>
                                <th></th>
                                <th></th>
                                <th>
                                    {{ number_format($TotTagihan,0) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
