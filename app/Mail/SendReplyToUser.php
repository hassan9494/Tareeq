<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReplyToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $productMessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productMessage)
    {
        $this->productMessage = $productMessage;
    }

    /**
     * Build the message
     * @return $this
     */
    public function build()
    {
        return $this->subject('You Have New Message')->view('frontend.mails.reply');
    }
}
