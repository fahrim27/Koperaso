@component('mail::message')
<p>Hai {{ $data['nama_anggota'] }}, </p>
<p>Selamat, pesanan Anda di koperasi sudah siap untuk diambil. Silahkan hubungi Tim Jual Beli Koperasi untuk informasi lebih lanjut.</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Pesanan
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
