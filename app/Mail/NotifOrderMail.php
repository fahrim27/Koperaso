<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data, $OrderDetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $OrderDetail)
    {
        $this->data = $data;  
        $this->OrderDetail = $OrderDetail;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[PESANAN BARU] Permintaan Pesanan Barang')
        ->markdown('emails.sites.notif_order');
    }
}
