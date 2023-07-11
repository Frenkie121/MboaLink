<?php

namespace App\Http\Livewire\Front\Subscriber;

use App\Actions\RequestSubscriptionRenewal;
use App\Models\{Subscription, User};
use Carbon\Carbon;
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

    public function sendRequest(RequestSubscriptionRenewal $requestSubscriptionRenewal)
    {
        $requestSubscriptionRenewal->send($this->last_subscription->id);

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

        // dd($this->user->currentSubscription()->lastSubscriptionDaysLeft());

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
