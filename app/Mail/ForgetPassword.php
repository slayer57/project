<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $randomString;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($randomString)
    {
        $this->randomString = $randomString;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Forgotten Password Verification')->from('roshanhumagain53@gmail.com', 'leideu')->view('mail.forgot-password');
    }
}
