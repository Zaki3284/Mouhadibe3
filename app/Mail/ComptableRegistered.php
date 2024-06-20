<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComptableRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $comptable;

    public function __construct($comptable)
    {
        $this->comptable = $comptable;
    }

    public function build()
    {
        return $this->view('emails.comptable_registered')
            ->with([
                'fullname' => $this->comptable->fullname,
            ]);
    }
}
