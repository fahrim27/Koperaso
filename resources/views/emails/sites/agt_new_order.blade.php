@component('mail::message')
<p>Hai {{ $data['nama_anggota'] }}, </p>
<p>Selamat, pesanan Anda di koperasi telah berhasil dicheckout. Silahkan tunggu pesanan di proses oleh Tim Jual Beli Koperasi</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Lihat Pesanan
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
