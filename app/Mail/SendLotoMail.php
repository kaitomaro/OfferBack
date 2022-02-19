<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLotoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $money, $prize)
    {
        $this->id = $id;
        $this->money = $money;
        $this->prize = $prize;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@eatap.co.jp')
        ->subject('ユーザー様が当選')
        ->view('email.prize')
        ->with(['id' => $this->id ,'money' => $this->money, 'prize' => $this->prize]);
    }
}
