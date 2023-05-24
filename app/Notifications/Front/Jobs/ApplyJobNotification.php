<?php

namespace App\Notifications\Front\Jobs;

use App\Models\{Job, User};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplyJobNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public Job $job,
        public User $user
    ){}

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
                ->subject(trans('New Job Application Notification'))
                ->when(
                    in_array($notifiable->role_id, [1, 2]),
                    fn ($mail) => $mail->line(trans('A new application for job: ') . $this->job->title . trans(' has been submitted by: ') . $this->job->company->user->name.'.'),
                    fn ($mail) => $mail->line(trans('Your application for job: ') . $this->job->title . trans(' has been successfully sent to the company: ') . $this->job->company->user->name . '.')
                )
                ->lineIf(
                    in_array($notifiable->role_id, [3, 4, 5]),
                    config('app.name') . ' ' . trans(' will guide you through this process.')
                )
                ->when(
                    $notifiable->role_id === 1,
                    fn ($mail) => $mail->action(trans('Go to job details'), url('/admin/jobs/' . $this->job->slug)),
                    function ($mail) use ($notifiable) {
                        if ($notifiable->role_id !== 6) {
                            return $mail->action(trans('Go to website'), url("jobs/{$this->job->slug}"));
                        } else {
                            return $mail->action(trans('Go to Dashboard'), url('/me/profile'));
                        }
                    }
                );
    }
}
