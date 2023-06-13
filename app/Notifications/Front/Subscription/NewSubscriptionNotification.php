<?php

namespace App\Notifications\Front\Subscription;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewSubscriptionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public array $data){}

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
                        ->subject(trans('New Subscription Request'))
                        ->lineIf(
                            $notifiable->role_id === 1,
                            trans('A new request for a type subscription: ') . trans($this->data['type']) . ',' . trans(' has been made by: ') . $this->data['from'] . '.'
                        )
                        ->lineIf(
                            $notifiable->role_id !== 1,
                            trans($this->data['message'])
                        )
                        ->lineIf(
                            $notifiable->role_id !== 1 && $this->data['type'] != 1,
                            trans('Click on the link below to create your password. It is valid for one hour.')
                        )
                        ->when($notifiable->role_id === 1,
                            fn ($mail) => $mail->action(trans('Go to subscription details'), url("/admin/subscribers/{$this->data['slug']}")),
                            fn ($mail) => $mail->action(trans('Create Password'), url(URL::temporarySignedRoute('password.create', now()->addHour(), ['email' => $this->data['email']]))),
                        )
                        ->lineIf(
                            $notifiable->role_id !== 1 && $this->data['type'] != 1,
                            trans('If the link has expired, you can use the password reset link on the login page to create a new one.')
                        );
    }
}
