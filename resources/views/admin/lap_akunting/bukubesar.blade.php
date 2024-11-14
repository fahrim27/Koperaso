@extends('layouts.app')
@section('content-app')
    @include('message.flash')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Buku Besar</h3>
                    <div class="card-options">
                        <form action="{{ url('admin/lap_akunting/bukubesar') }}" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="changename">Nama Akun</label>
                                        <select class="js-example-basic-single w-100" name="kde_akun" id="single2">
                                            <option value="">-- Pilih Akun --</option>
                                            @foreach ($Akun as $k)
                                                <option value="{{ $k->kde_akun }}"
                                                    @if ($KodeAkun == $k->kde_akun) selected='selected' @endif>
                                                    @if ($k->pos_akun == 1)
                                                        <b>{{ $k->nma_akun }}</b>
                                                    @else
                                                        &nbsp;&nbsp;{{ $k->nma_akun }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">{{ $errors->first('kde_akun') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Filter Periode</label>
                                        <input type="date" name="tgl_mulai" class="form-control"
                                            value="{{ $TglMulai }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <input type="date" name="tgl_selesai" class="form-control"
                                            value="{{ $TglSelesai }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            formaction="{{ url('admin/lap_akunting/bukubesar') }}"><i
                                                class="fa fa-table"></i> Tampilkan</button>
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            formaction="{{ url('admin/lap_akunting/bukubesar/cetak') }}"
                                            formtarget="_blank"><i class="fa fa-print"></i> Cetak Buku Besar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if ($BukBes != [])
                        <table id="#" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No Transaksi</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($BukBes as $Akt)
                                    <tr>
                                        <td>
                                            {{ $Akt->tanggal }}
                                        </td>
                                        <td>
                                            {{ $Akt->no_bukti }}
                                        </td>
                                        <td align="right">
                                            {{ number_format($Akt->debet, 2) }}
                                        </td>
                                        <td align="right">
                                            {{ number_format($Akt->kredit, 2) }}
                                        </td>
                                        <td>
                                            {{ $Akt->keterangan }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" align="center" class="font-weight-bold">
                                        TOTAL
                                    </td>
                                    <td align="right" class="font-weight-bold">
                                        {{ number_format($TotDebet, 2) }}
                                    </td>
                                    <td align="right" class="font-weight-bold">
                                        {{ number_format($TotKredit, 2) }}
                                    </td>
                                    <td align="right" class="font-weight-bold">
                                        {{ number_format($SaldoAkhir, 2) }}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
