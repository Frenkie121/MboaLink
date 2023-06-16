<?php

namespace App\Notifications\admin\Job;

use Illuminate\Bus\Queueable;
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
        $hour = date('H');
        $greeting = ($hour > 17) ? trans('Evening ') : (($hour > 12 && $hour <= 18) ? trans('Afternoon ') : trans('Morning '));

        return (new MailMessage)
            ->greeting(trans('Good ').$greeting.$notifiable->name)
            ->subject(trans('Publication Job Notification'))
            ->line(trans('You receive this e-mail to confirm the publication of your job, the title of which is: ').$this->job->title)
            ->line($this->data)
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
