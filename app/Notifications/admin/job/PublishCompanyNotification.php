<?php

namespace App\Notifications\Admin\Job;

use App\Models\Job;
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
    public function __construct(public Job $job)
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
            ->greeting(greeting() . $notifiable->name)
            ->when(
                $notifiable->role_id === 2,
                fn ($mail) => $mail->subject('🎉✨ ' . trans('Job offer published') . ' 🎉✨'),
                fn ($mail) => $mail->subject(trans('New Job publication')),
            )
            ->lineIf(
                $notifiable->role_id === 2,
                trans('You are receiving this e-mail to confirm the publication of your job offer, the title of which is: ') . $this->job->title . trans(', submitted at ') . $this->job->created_at . '.'
            )
            ->lineIf(
                $notifiable->role_id !== 2,
                trans('A new job offer ') . $this->job->title . ',' . trans(' from category ') . $this->job->subCategory->category->name . ',' . trans(' from the company ') . $this->job->company->user->name . ',' . trans(' has been published on the website.')
            )
            ->lineIf(
                $notifiable->role_id !== 2,
                trans('Click on the link below to see details.')
            )
            ->when(
                $notifiable->role_id !== 2,
                fn ($mail) => $mail->action(trans('Go to job details'), route('front.jobs.show', $this->job)),
                fn ($mail) => $mail->action(trans('Go to website'), url('/jobs')),
            );
    }
}
