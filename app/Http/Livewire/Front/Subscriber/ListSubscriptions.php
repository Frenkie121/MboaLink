<?php

namespace App\Http\Livewire\Front\Subscriber;

use App\Models\User;
use Livewire\Component;

class ListSubscriptions extends Component
{
    public function render()
    {
        $user = User::query()->findOrFail(auth()->id());
        return view('livewire.front.subscriber.list-subscriptions', [
            'subscriptions' => $user->subscriptions()->latest()->paginate(5),
        ])
        ->layout('front.subscribers.main-layout', ['subtitle' => trans('My Subscriptions')]);
    }
}
