@component('mail::message')
<p>Hai {{ $data['nama_anggota'] }}, </p>
<p>Pengajuan pinjaman Anda masih dalam proses verifikasi. Masuk ke website koperasi untuk melihat detail pengajuan</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Pengajuan
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
