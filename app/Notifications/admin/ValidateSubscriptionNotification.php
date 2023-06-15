<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValidateSubscriptionNotification extends Notification
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
            ->subject("🎉✨" . trans('Subscription activated') . "🎉✨")
            ->line(
                trans('Your subscription ') . $this->data['type'] . __(' made on ') . formatedLocaleDate($this->data['created_at']) . __(' has been validated and is now active.')
            )
            ->line(
                __('It takes effect from ') . formatedLocaleDate(now()) . __(' to ') . formatedLocaleDate($this->data['ends_at']) . trans(' at ') . $this->data['ends_at']->format('H:i') . '.'
            )
            ->action(trans('Go to website'), url('/jobs'))
            ->when(
                $this->data['type'] === 1,
                fn ($mail) => $mail->action(trans('Go to website'), url('/jobs')),
                fn ($mail) => $mail->action(trans('Go to Dashboard'), route('front.subscriber.subscriptions'))
            );
    }
}
