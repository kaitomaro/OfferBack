<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($random_int)
    {
        $this->random_int = $random_int;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@eatap.co.jp')
        ->subject('【Eatap】パスワード再設定用')
        ->view('email.forget_pass')
        ->with(['random_int' => $this->random_int]);
    }
}
