<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Formulir Pendaftaran Anggota</title>
    <link rel="shortcut icon" href="{{ url('') }}/public/logokop.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="page">
        <div class="text-center my-2">
            <a href="{{ url('/admin/master_anggota/download/' . $PbyPengajuan->id) }}"><img
                    src="{{ asset('public/admin/template') }}/images/logokop.png" alt="logo" width="300" height="100"></a>
        </div>
        <h6 align="center">FORMULIR PERMOHONAN PINJAMAN</h6>
        <h6 align="center">{{ companySetting('nama_koperasi') }}</h6>
        <br>
        <p>
            Saya yang bertanda tangan di bawah ini:
        </p>
        <table id="#" class="table table-striped" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="30%">Nama Lengkap</td>
                    <td width="5%">:</td>
                    <td align="left">{{ $PbyPengajuan->Anggota->nama_anggota }}
                    </td>
                </tr>
                <tr>
                    <td width="20%">Jenis Kelamin</td>
                    <td width="5%">:</td>
                    <td align="left">{{ $PbyPengajuan->Anggota->jenis_kelamin }}
                    </td>
                </tr>
                <tr>
                    <td width="20%">No. KTP</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->no_ktp }}</td>
                </tr>
                <tr>
                    <td width="20%">Tempat, Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->tempat_lahir }}, {{
                         \Carbon\Carbon::parse($PbyPengajuan->Anggota->tgl_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td width="20%">Alamat</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->alamat }}</td>
                </tr>
                <tr>
                    <td width="20%">Alamat Domisili</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->alamat_domisili }}</td>
                </tr>
                <tr>
                    <td width="20%">NIK (ID Karyawan)</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->nik }}</td>
                </tr>                
                <tr>
                    <td width="20%">Perusahaan - Department</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->Perusahaan->nama }} - {{  $PbyPengajuan->Anggota->Department->nama }}</td>
                </tr>                
                <tr>
                    <td width="20%">Status Karyawan</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->status_karyawan }}</td>
                </tr>
                <tr>
                    <td width="20%">Email</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->email }}</td>
                </tr>
                <tr>
                    <td width="20%">No. Telp</td>
                    <td>:</td>
                    <td>{{  $PbyPengajuan->Anggota->no_telpon }}</td>
                </tr>                
            </tbody>
        </table>
        <p>Dengan ini mengajukan permohonan pinjaman kepada {{ companySetting('nama_koperasi') }} dengan rincian sebagai berikut :</p>

        <table id="#"  class="table table-striped" width="100%" cellspacing="0">
            <tr>
                <td width="30%">Jenis Pinjaman</td>
                <td width="5%">:</td>
                <td align="left">{{ $PbyPengajuan->PbyMaster->nama }}
                </td>
            </tr>
            <tr>
                <td width="20%">Jumlah Pengajuan</td>
                <td width="5%">:</td>
                <td align="left">Rp. {{ number_format($PbyPengajuan->nominal) }}
                </td>
            </tr>
            <tr>
                <td width="20%">Jangka Waktu (Tenor)</td>
                <td width="5%">:</td>
                <td align="left">{{ number_format($PbyPengajuan->jangka) }} Bulan
                </td>
            </tr>
            <tr>
                <td width="20%">Keperluan Pinjaman</td>
                <td width="5%">:</td>
                <td align="left">{{ $PbyPengajuan->keperluan }}
                </td>
            </tr>
            <tr>
                <td width="20%">Jenis Jaminan</td>
                <td width="5%">:</td>
                <td align="left">{{ $PbyPengajuan->jaminan }}
                </td>
            </tr>
        </table>
        <p>
            Demikian permohonan pinjaman ini saya sampaikan kepada Pengurus {{ companySetting('nama_koperasi') }} untuk dapat disetujui. Atas
perhatiannya saya ucapkan terima kasih.
        </p>
        

        <table border=0 width="100%">
            <tr>
                <td>Menyetujui/Mengetahui</td>
                <td align="center" width="30%">Jakarta, {{ \Carbon\Carbon::parse(now())->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Pengurus Koperasi</td>
                <td align="center">Pemohon</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td rowspan="3" align="center"><br>
                    <img
                    src="{{ asset('public/images/esign') }}/{{ $PbyPengajuan->foto_ttd }}"  width="150px" height="100px">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>________________________</td>
                <td align="center">________________________</td>
            </tr>
            <tr>
                <td>Rani Indriani</td>
                <td align="center">{{ $PbyPengajuan->Anggota->nama_anggota }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
