<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($name, $email, $sentence)
    {
        $this->name = $name;
        $this->email = $email;
        $this->sentence = $sentence;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@eatap.co.jp')
        ->subject('ユーザー様からお問い合わせ')
        ->view('email.contact_us')
        ->with(['name' => $this->name ,'email' => $this->email, 'sentence' => $this->sentence]);
    }
}

