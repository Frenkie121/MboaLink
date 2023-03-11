<?php

namespace App\Notifications\publish;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class PublishCompanyNotification extends Notification
{
    use Queueable,ShouldQueue;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $job, public $data)

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
            ->greeting('Hello  ' . $this->job->company->name)
            ->subject('Confirmation  de publication du job')
            ->line('Vous recevez cet e-mail pour vous confirmer effectivement la publication de votre job dont le titre est : ' . $this->job->title)
            ->action('Consulter la liste des autres jobs disponibles', url('/'))
            ->line('Thank you for using our application!')
            ->from('Mboalink', 'Administrator')
            ->line('...');
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
