<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminId;
    public $info;
    public $messageContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($adminId, $info, $messageContent)
    {
        $this->adminId = $adminId;
        $this->info = $info;
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.product_notification')
            ->subject('تحديث منتج')
            ->with([
                'adminId' => $this->adminId,
                'info' => $this->info,
                'messageContent' => $this->messageContent,
            ]);
    }
}
