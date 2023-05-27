<?php

namespace App\Http\Livewire\Front\Subscriber;

use App\Models\{Subscription, User};
use App\Notifications\Front\Subscription\SubscriptionRenewalRequestNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ListSubscriptions extends Component
{
    public User $user;
    public Subscription $last_subscription;

    public function mount()
    {
        $this->user = User::query()->findOrFail(auth()->id());
        $this->last_subscription = $this->user->subscriptions->last();  
    }

    public function sendRequest()
    {
        $this->user->subscriptions()->attach($this->last_subscription->id, [
            'amount' => $this->last_subscription->amount,
        ]);

        // For admin validation
        // $last_ends_date = Carbon::parse($last_subscription->pivot->ends_at);
        // $this->user->subscriptions()->wherePivot('id', $last_subscription->pivot->id)->attach($last_subscription->id, [
        //     'amount' => $subscription->amount,
        //     'starts_at' => $last_ends_date->isPast() ? now() : $last_ends_date,
        //     'ends_at' => $last_ends_date->isPast() ? now()->addWeeks($subscription->duration) : $last_ends_date->addWeeks($subscription->duration)
        // ]);
        
        // EMAIL
        $message = trans('Your subscription renewal request as been successfully sent. You will be contacted shortly via WhatsApp by administrator for further details in order to validate your subscription.');
        $data = [
            'message' => $message,
            'type' => $this->last_subscription->name,
            'slug' => $this->user->slug,
            'from' => $this->user->name,
        ];

        Notification::send([User::query()->firstWhere('role_id', 1), $this->user], new SubscriptionRenewalRequestNotification($data));

        alert('', $message . ' ' . trans('An email has been sent to you.'), 'success')->autoclose(25000);

        $this->redirectRoute('front.subscriber.subscriptions');
    }

    public function render()
    {
        $starts_at = Carbon::parse($this->last_subscription->pivot->ends_at)->isPast() ? now() : Carbon::parse($this->last_subscription->pivot->ends_at);

        $ends_at = Carbon::parse($this->last_subscription->pivot->ends_at)->isPast() ? now()->addWeeks($this->last_subscription->duration) : Carbon::parse($this->last_subscription->pivot->ends_at)->addWeeks($this->last_subscription->duration);


        $next_subscription = [
            'amount' => $this->last_subscription->amount,
            'starts_at' => formatedLocaleDate($starts_at),
            'ends_at' => formatedLocaleDate($ends_at),
        ];

        return view('livewire.front.subscriber.list-subscriptions', [
            'subscriptions' => $this->user->subscriptions()->orderByPivot('ends_at', 'DESC')->orderByPivot('starts_at', 'DESC')->paginate(5),
            'current_subscription' => $this->user->currentSubscription(),
            'days_left' => $this->user->currentSubscription()->lastSubscriptionDaysLeft(),
            'last_subscription' => $this->user->subscriptions->last(),
            'next_subscription' => $next_subscription,
        ])
        ->layout('front.subscribers.main-layout', ['subtitle' => trans('My Subscriptions')]);
    }
}
