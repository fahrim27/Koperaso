@component('mail::message')
<p>Hai {{ $data['nama_anggota'] }}, </p>
<p>Selamat, pembayaran Anda telah diverifikasi dan pesanan Anda di koperasi sedang diproses oleh Tim Jual Beli Koperasi</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Pesanan
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
