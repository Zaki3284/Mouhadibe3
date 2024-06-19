<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmailNotification
{
    /**
     * Get the verification mail message for the given URL.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($notifiable)
    {
        $url = $this->verificationUrl($notifiable);
        return (new MailMessage)
            ->greeting(__('auth.hello', ['name' => $notifiable->name]))
            ->line(__('auth.thank_you_for_registering'))
            ->action(__('auth.please_click_the_following_link_to_confirm_your_email_address'), $url)
            ->line(__('auth.no_further_action'))
            ->salutation(__('auth.regards') . ',<br>' . config('app.name'));
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->buildMailMessage($notifiable);
    }
}
