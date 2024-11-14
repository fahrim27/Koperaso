@component('mail::message')
<p>Silahkan klik tombol di bawah ini untuk mengatur ulang kata sandi Anda.</p>

@component('mail::button', ['url' => $data['url']], 'pink')
Atur Ulang Kata Sandi
@endcomponent

Terimakasih,<br>
PENGURUS<br>
{{ companySetting('nama_koperasi') }}
@endcomponent
