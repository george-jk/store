<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $username)
    {
        $this->order=$order;
        $this->username=$username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Поръчка от profitstore.bg')
        ->markdown('mail.order-created');
    }
}
