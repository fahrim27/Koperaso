@extends('layouts_print.app_print')
@section('content-app')
    <br>
    <h3 align="center"> Bukti Serah Terima Barang</h3>
    <hr>
    <table id="#" border="0" style="margin-left: 25px" width="100%" cellspacing="0">
        <tbody>
            <tr>
                <td width="30%">Nama Lengkap</td>
                <td width="2%">:</td>
                <td align="left">
                    {{ $JbOrder->Anggota->nama_anggota }}
                </td>
            </tr>
            <tr>
                <td width="30%">Department</td>
                <td width="2%">:</td>
                <td align="left">
                    {{ $JbOrder->Anggota->Department->nama }} - {{ $JbOrder->Anggota->Perusahaan->nama }}
                </td>
            </tr>
            <tr>
                <td width="30%">Tgl Transaksi</td>
                <td width="2%">:</td>
                <td align="left">
                    {{ \Carbon\Carbon::parse($JbOrder->tanggal)->translatedFormat('d F Y') }}
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <div style="margin-left: 25px">
        <p>Daftar Pesanan</p>
        <div class="table-responsive w-100">
            <table class="table">
                <thead>
                    <tr class="bg-dark text-white">
                        <th>Nama Barang</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Jml Barang</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp

                    @foreach ($DetailOrder as $p)
                        @php $total += $p->harga * $p->qty @endphp
                        <tr class="text-right">
                            <td class="text-left">{{ $p->MsProduk->nama_barang }}</td>
                            <td>Rp {{ number_format($p->harga) }}</td>
                            <td>{{ $p->qty }}</td>
                            <td>Rp {{ number_format($p->harga * $p->qty) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right">
                            <h3><strong>Total &nbsp;&nbsp;&nbsp; Rp {{ number_format($total) }}</strong>
                            </h3>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <hr>
    <table border=0 width="100%">
        <tr>
            <td>Menyetujui/Mengetahui</td>
            <td align="center" width="30%">{{
                \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Pengurus Koperasi</td>
            <td align="center">Anggota</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>________________________</td>
            <td align="center">________________________</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"></td>
        </tr>
    </table>
@endsection
