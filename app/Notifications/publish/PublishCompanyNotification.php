<?php

namespace App\Notifications\publish;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
            ->greeting(trans('Hello ').$this->job->company->name)
            ->subject(trans('Confirmation de publication du job'))
            ->line($this->data)
            ->line(trans('You receive this e-mail to confirm the publication of your job, the title of which is: ').$this->job->title)
            ->action(trans('Consult the list of other available jobs'), url('/'))
            ->line(trans('Thank you for using our application!'))
            ->from('admin@Mboalink.com', trans('Administrator'))
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
