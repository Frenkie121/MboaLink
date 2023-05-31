<?php

namespace App\Notifications\Front\Subscription;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionRenewalRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(greeting() . $notifiable->name)
            ->subject(trans('Subscription Renewal Request'))
            ->lineIf(
                $notifiable->role_id === 1,
                trans('A request for a renewal subscription ') . trans($this->data['type']) . ',' . trans(' has been made by: ') . $this->data['from'] . '.'
            )
            ->lineIf(
                $notifiable->role_id !== 1,
                trans($this->data['message'])
            )
            ->when(
                $notifiable->role_id === 1,
                fn ($mail) => $mail->action(trans('Go to subscription details'), url("/admin/subscribers/{$this->data['slug']}")),
                fn ($mail) => $mail->action(trans('Go to Dashboard'), url('/me/my-subscriptions')),
            );
    }
}
