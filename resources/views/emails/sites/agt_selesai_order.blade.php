@component('mail::message')
<p>Hai {{ $data['nama_anggota'] }}, </p>
<p>Pesanan Anda telah selesai. Terimakasih sudah transaksi melalui {{ companySetting('nama_koperasi') }}.</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Pesanan
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
