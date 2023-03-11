<?php

namespace App\Notifications\publish;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PublishCompanyFrNotification extends Notification
{
    use Queueable;

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
            ->greeting(Lang::get('Bonjour ').$this->job->company->user->name)
            ->subject(Lang::get('Job publication '))
            ->line($this->data)
            ->line(Lang::get('Vous recevez cet e-mail de publication concernant le job dont le titre est:'.$this->job->title))
            ->action(Lang::get('Consulter la liste des autres jobs disponibles'), url('/'))
            ->line(Lang::get('Thank you for using our application!'))
            // ->from('Mboalink', 'Administrateur')
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
