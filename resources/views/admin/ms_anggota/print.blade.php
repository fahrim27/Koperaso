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
            <a href="{{ url('/admin/master_anggota/download/' . $MsAnggota->id) }}"><img
                    src="{{ asset('public/admin/template') }}/images/logokop.png" alt="logo" width="300" height="100"></a>
        </div>
        <h6 align="center">FORMULIR PERMOHONAN KEANGGOTAAAN</h6>
        <h6 align="center">{{ companySetting('nama_koperasi') }}</h6>
        <br>
        <p>
            Saya yang bertanda tangan di bawah ini:
        </p>
        <table id="#" class="table table-striped" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="20%">Nama Lengkap</td>
                    <td width="5%">:</td>
                    <td align="left">{{ $MsAnggota->nama_anggota }}
                    <td>
                </tr>
                <tr>
                    <td width="20%">Jenis Kelamin</td>
                    <td width="5%">:</td>
                    <td align="left">{{ $MsAnggota->jenis_kelamin }}
                    <td>
                </tr>
                <tr>
                    <td width="20%">No. KTP</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->no_ktp }}<td>
                </tr>
                <tr>
                    <td width="20%">Tempat, Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->tempat_lahir }}, {{ \Carbon\Carbon::parse($MsAnggota->tgl_lahir)->translatedFormat('d F Y') }}<td>
                </tr>
                <tr>
                    <td width="20%">Alamat</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->alamat }}<td>
                </tr>
                <tr>
                    <td width="20%">Alamat Domisili</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->alamat_domisili }}<td>
                </tr>
                                
                <tr>
                    <td width="20%">Nama Perusahaan</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->Perusahaan->nama }}<td>
                </tr>
                <tr>
                    <td width="20%">Department</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->Department->nama }}<td>
                </tr>
                <tr>
                    <td width="20%">NIK (ID Karyawan)</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->nik }}<td>
                </tr>
                <tr>
                    <td width="20%">Status Karyawan</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->status_karyawan }}<td>
                </tr>
                <tr>
                    <td width="20%">Email</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->email }}<td>
                </tr>
                <tr>
                    <td width="20%">No. Telp</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->no_telpon }}<td>
                </tr>
                <tr>
                    <td width="20%">No. Telpon (Orang tua/Suami/Istri/Saudara)</td>
                    <td>:</td>
                    <td>{{  $MsAnggota->kontak_darurat }}<td>
                </tr>
            </tbody>
        </table>
        <p>Bersedia membayar Simpanan Pokok sebesar Rp {{ number_format($MsAnggota->Jabatan->simp_pokok) }} dan Simpanan Wajib sebesar Rp {{ number_format($MsAnggota->Jabatan->simp_wajib) }}/bulan serta memenuhi semua ketentuan yang tertera dalam Anggaran Dasar, Anggaran Rumah Tangga, Peraturan khusus dan kebijakan lainnya yang ada di {{ companySetting('nama_koperasi') }}. Demikian Formulir ini saya isi dengan keterangan yang benar.</p>

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
                <td align="center">{{ $MsAnggota->nama_anggota }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
