<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $urls)
    {
        $this->request = $request;
        $this->urls = $urls;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@eatap.co.jp')
        ->subject('【Eatap】ご利用開始のお手続き')
        ->view('email.authorize')
        ->with([
            'urls' => $this->urls,
            'text' => $this->request->text,
        ]);
    }
}
