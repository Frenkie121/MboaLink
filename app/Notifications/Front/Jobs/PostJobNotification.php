<?php

namespace App\Notifications\Front\Jobs;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostJobNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Job $job){}

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
        $greeting = ($hour > 17) ? trans("Evening ") : (($hour > 12) ? trans("Afternoon ") : trans("Morning "));
        return (new MailMessage)
                    ->greeting($greeting . $notifiable->name)
                    ->subject(trans('New Job Submission Notification'))
                    ->lineIf(
                        $notifiable->role_id === 1,
                        trans('A new job ') . $this->job->title . ' ' . trans('has been submitted by ') . $this->job->company->user->name . '.'
                    )
                    ->lineIf(
                        $notifiable->role_id === 2,
                        trans('Your job ') . $this->job->title . (' has been successfully registered. It will be studied and you will be informed of its publication or not as soon as possible.')
                    )
                    ->when($notifiable->role_id === 1, 
                        fn($mail) => $mail->action(trans('Go to job details'), url('/admin/jobs')),
                        fn($mail) => $mail->action(trans('Go to website'), url('/admin/jobs')),
                    );
    }
}