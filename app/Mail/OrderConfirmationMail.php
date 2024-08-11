<?php

namespace App\Mail;

use App\Models\Bills;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $bill;
    public function __construct(Bills $bill)
    {
        $this->bill = $bill;
    }
     /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Order Confirmation')
            ->markdown('client.orders.mail')
            ->with('bill', $this->bill);
    }
}
