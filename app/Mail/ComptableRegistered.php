<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComptableRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $fullname;
    public $confirmationUrl;
    public $companyName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullname, $confirmationUrl, $companyName)
    {
        $this->fullname = $fullname;
        $this->confirmationUrl = $confirmationUrl;
        $this->companyName = $companyName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.comptable_registered')
            ->with([
                'fullname' => $this->fullname,
                'confirmationUrl' => $this->confirmationUrl,
                'companyName' => $this->companyName,
            ]);
    }
}
