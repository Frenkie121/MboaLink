<?php

namespace App\Notifications\admin\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class replyMessageNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $reply, public $Subject)
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
            ->greeting(greeting().$notifiable->name)
            ->subject(trans('Reply : '.$this->Subject))
            ->line($this->reply)
            ->when(
                $notifiable->role_id === 1,
                fn ($mail) => $mail->action(trans('Go to job details'), url('/admin/jobs')),
                fn ($mail) => $mail->action(trans('Go to website'), url('/jobs')),
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
