<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValidateNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $ends_at)
    {
        //
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
            ->greeting(trans('Good ') . $greeting . $notifiable->name)
            ->subject("🎉✨" . trans('Congratulations on the activation of your subscription') . "🎉✨")
            ->line(trans('You will receive this email to confirm the validation of your subscription, which will take effect from this date on :') . $this->ends_at)
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
