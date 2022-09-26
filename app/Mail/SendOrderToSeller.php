<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderToSeller extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$product)
    {
        $this->order = $order;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Order')->view('frontend.mails.orderToSeller');
    }
}
