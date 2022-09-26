<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLessonCanceled extends Mailable
{
    use Queueable, SerializesModels;

    public $lesson;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Build the message
     * @return $this
     */
    public function build()
    {
        return $this->subject('Lesson Canceled')->view('frontend.mails.lesson_canceled');
    }
}
