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
        $sentence = __(' made on ') . formatedLocaleDate($this->data['created_at']) . __(' has been validated and is now active.');
        $starts_at = $notifiable->subscriptions->count() === 1 ? now() : formatedLocaleDate($this->data['starts_at']);

        return (new MailMessage)
            ->greeting(greeting() . $notifiable->name)
            ->subject("🎉✨" . trans('Subscription activated') . "🎉✨")
            ->when(
                $notifiable->subscriptions->count() === 1,
                fn ($mail) => $mail->line(
                    trans('Your subscription ') . $this->data['type'] . $sentence
                ),
                fn ($mail) => $mail->line(
                    trans('Your renewal request for subscription ') . $this->data['type'] . $sentence
                ),
            )
            ->line(
                __('It takes effect from ') . $starts_at . __(' to ') . formatedLocaleDate($this->data['ends_at']) . trans(' at ') . $this->data['ends_at']->format('H:i') . '.'
            )
            ->when(
                $this->data['type_id'] === 1,
                fn ($mail) => $mail->action(trans('Go to website'), url('/jobs')),
                fn ($mail) => $mail->action(trans('Go to Dashboard'), route('front.subscriber.subscriptions'))
            );
    }
}
