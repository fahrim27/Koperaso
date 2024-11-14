@component('mail::message')
<h2>Informasi Pendaftaran Anggota</h2>
<table width="100%" cellspacing="0">
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
            <td width="35%">Jenis Kelamin</td>
            <td>:</td>
            <td>{{  $data['jenis_kelamin'] }}<td>
        </tr>
        <tr>
            <td width="35%">Tempat, Tanggal Lahir</td>
            <td>:</td>
            <td>{{  $data['tempat_lahir'] }}, {{ \Carbon\Carbon::parse($data['tgl_lahir'])->translatedFormat('d F Y') }}<td>
        </tr>
        <tr>
            <td width="35%">Email</td>
            <td>:</td>
            <td>{{  $data['email'] }}<td>
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
    <tbody>
</table>

@component('mail::button', ['url' => $data['url']], 'pink')
Verifikasi Anggota
@endcomponent

@endcomponent
