<?php

namespace App\Notifications\publish;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PublishCompanyNotification extends Notification
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
            ->greeting(Lang::get('Hello ').$this->job->company->user->name)
            ->subject(Lang::get('Job publication '))
            ->line($this->data)
            ->line(Lang::get('You receive this e-mail about the publication of your job, the title of which is:'.$this->job->title))
            ->action(Lang::get('Consult the list of other available jobs'), url('/'))
            ->line(Lang::get('Thank you for using our application!'))
            // ->from('Mboalink', 'Administrator')
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
