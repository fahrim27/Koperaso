@php
$total = 0
@endphp
<style>
    table.order {
      border-collapse: collapse;
      width: 100%;
    }
    table.order
    th, tr, td {
      text-align: left;
      padding: 5px;
    }
    table.order
    th {
      background-color: #000;
      color: #fff;
    }
    table.order
    tr:nth-child(even) {
        background-color: #e9eaf8;
      }
    </style>
@component('mail::message')
<h3>Permintaan Pesanan Baru</h3>
<table width="100%" cellspacing="0" class="tab">
    <tbody class="tab">
        <tr>
            <td width="35%">Nama Anggota</td>
            <td width="5%">:</td>
            <td align="left">{{ $data['nama_anggota'] }}
            <td>
        </tr>
        <tr>
            <td width="35%">Perusahaan</td>
            <td>:</td>
            <td>{{ $data['perusahaan'] }}
            <td>
        </tr>
    </tbody>
</table>
<br>
<table width="100%" cellspacing="0" border="0" class="order">
    <thead>
        <tr>
            <th width="50%">Nama Barang</th>
            <th align="right" width="20%">Harga</th>
            <th align="right" width="10%">Qty</th>
            <th align="right" width="20%">Total</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($OrderDetail as $p => $Orders)
            @php
            $total += $Orders['harga'] * $Orders['qty']
            @endphp
            <tr>
                <td align="left">{{ $Orders["nama_barang"] }}</td>
                <td align="right">Rp {{ number_format($Orders["harga"]) }}</td>
                <td align="right">{{ $Orders["qty"] }}</td>
                <td align="right">Rp {{ number_format($Orders["harga"]*$Orders["qty"]) }}</td>
            </tr>
        @endforeach
        <tfoot>
            <tr align="right">
                <td colspan="3" align="right">
                    <h3><strong>TOTAL &nbsp;&nbsp;&nbsp; </strong>
                    </h3>
                </td>
                <td align="right"><b>Rp {{ number_format($total) }}<b></td>
            </tr>
        </tfoot>
    </tbody>
</table>
@endcomponent
