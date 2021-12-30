<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifikasiBuku extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $transaksi = $this->transaksi;

        return $this->subject('Pemberitahuan Peminjaman Buku Perpustakaan')
                    ->from('epic1.global@gmail.com', 'PSDKU-Samarinda')
                    ->markdown('emails.verifikasi-buku',compact('transaksi'));
    }
}
