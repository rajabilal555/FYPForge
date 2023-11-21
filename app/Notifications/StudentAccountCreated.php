<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAccountCreated extends Notification
{
    use Queueable;

    protected string $newPassword;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Your account has been created on '.config('app.name').'!')
            ->line('Your username is: '.$notifiable->email)
            ->line('Your password is: '.$this->newPassword)
            ->action('Login to your account', url('/'));
    }
}
