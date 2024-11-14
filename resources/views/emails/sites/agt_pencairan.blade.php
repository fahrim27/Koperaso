@component('mail::message')
<p>Selamat, pengajuan pinjaman Anda telah dicairkan ke rekening Bank BCA.</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Detail Pinjaman
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
