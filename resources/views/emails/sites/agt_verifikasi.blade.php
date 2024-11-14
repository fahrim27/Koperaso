@component('mail::message')

<h3>Hai, {{ $data['nama_anggota'] }}</h3>
<p>Selamat, Anda telah terdaftar sebagai Anggota {{ companySetting('nama_koperasi') }}</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Masuk ke Akun Anda
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
