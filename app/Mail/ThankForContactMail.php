<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankForContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $sentence)
    {
        $this->name = $name;
        $this->sentence = $sentence;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@eatap.co.jp')
        ->subject('お問い合わせの確認')
        ->view('email.thank_for_contact')
        ->with(['name' => $this->name ,'sentence' => $this->sentence]);
    }
}
