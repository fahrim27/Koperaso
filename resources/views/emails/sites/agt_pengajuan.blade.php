@component('mail::message')
<h2>Informasi Pengajuan Pinjaman</h2>
<table width="100%" cellspacing="1">
    <tbody>
        <tr>
            <td width="35%">Nama Anggota</td>
            <td width="5%">:</td>
            <td align="left">{{  $data['nama'] }}<td>
        </tr>
        <tr>
            <td width="35%">Perusahaan</td>
            <td>:</td>
            <td>{{  $data['perusahaan'] }}<td>
        </tr>
        <tr>
            <td width="35%">Status Karyawan</td>
            <td>:</td>
            <td>{{  $data['status_karyawan'] }}<td>
        </tr>
        <tr>
            <td width="35%">No. Telp</td>
            <td>:</td>
            <td>{{  $data['no_telpon'] }}<td>
        </tr>
        <tr>
            <td width="35%">Alamat</td>
            <td>:</td>
            <td>{{  $data['alamat'] }}<td>
        </tr>
        <tr>
            <td width="35%">Alamat Domisili</td>
            <td>:</td>
            <td>{{  $data['alamat_domisili'] }}<td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td width="35%">Jenis Pinjaman</td>
            <td width="5%">:</td>
            <td align="left">{{ $data['jenis'] }}<td>
        </tr>
        <tr>
            <td width="35%">Nominal Pengajuan</td>
            <td width="5%">:</td>
            <td align="left">Rp. {{  number_format($data['nominal']) }}<td>
        </tr>
        <tr>
            <td width="35%">Jangka Waktu</td>
            <td width="5%">:</td>
            <td align="left">{{  number_format($data['jangka']) }} Bulan<td>
        </tr>
        <tr>
            <td width="35%">Jaminan</td>
            <td width="5%">:</td>
            <td align="left">{{ $data['jaminan'] }}<td>
        </tr>
        <tr>
            <td width="20%">Keperluan</td>
            <td width="5%">:</td>
            <td align="left">{{ $data['keperluan'] }}<td>
        </tr>
    <tbody>
</table>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Pengajuan
@endcomponent

@endcomponent
