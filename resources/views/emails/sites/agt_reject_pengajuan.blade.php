@component('mail::message')
<p>Hai {{ $data['nama_anggota'] }}, </p>
<p>Mohon maaf, untuk saat ini pengajuan pinjaman Anda belum disetujui. Silahkan hubungi tim koperasi simpan pinjam</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Pengajuan
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
