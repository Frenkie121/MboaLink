<?php

namespace App\Notifications\Front\Contact;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewContactNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Contact $contact){}

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
                        ->when($notifiable->role_id === 1,
                            fn($mail) => $mail->subject(trans('New Message')),
                            fn($mail) => $mail->subject(trans('Message Sent'))
                        )
                        ->lineIf(
                            $notifiable->role_id === 1,
                            trans('A new message for: ') . $this->contact->subject . trans(', has been sent by ') . $this->contact->name . '.'
                        )
                        ->lineIf(
                            $notifiable->role_id === 1,
                            trans('The content of the message: ') . $this->contact->message
                        )
                        ->lineIf(
                            $notifiable->role_id !== 1,
                            trans('Your message for: ') . $this->contact->subject . trans(' has been successfully sent to the administrator. You will receive a response as soon as possible.')
                        )
                        ->when($notifiable->role_id === 1, 
                            fn($mail) => $mail->action(trans('Go to contacts'), url('/admin/dashboard')),
                            fn($mail) => $mail->action(trans('Go to website'), url('/')),
                        );
    }
}
