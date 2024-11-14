@component('mail::message')
<p>Hai {{ $data['nama_anggota'] }}, </p>
<p>Selamat, pengajuan pinjaman Anda telah disetujui. Masuk ke website koperasi untuk melihat detail pengajuan</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Pengajuan
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
