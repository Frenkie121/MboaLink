<?php

namespace App\Http\Controllers\Front;

use App\Actions\RequestSubscriptionRenewal;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\{Subscription};

class SubscriptionController extends Controller
{
    /**
     * Display listing subscription plans
     */
    public function index(): View
    {
        return view('front.subscriptions.index', [
            'subscriptions' => Subscription::query()
                                        ->with(['offers:id,content,subscription_id'])
                                        ->get(['id', 'name', 'slug', 'amount']),
        ]);
    }

    public function subscribe(Subscription $subscription)
    {
        return view('front.subscriptions.subscribe', [
            'subscription' => $subscription,
        ]);
    }

    public function showRenewPage()
    {
        $user = auth()->user();
        $type = $this->getNextSubscriptionType();
        
        abort_if($user->role_id !== 6, 403);
        
        $current_subscription = $user->subscriptions->first();
        $subscription = Subscription::query()->findOrFail($type);
        $current_ends_at = Carbon::parse($current_subscription->pivot->ends_at)->isPast();
        $starts_at = $current_ends_at ? now()
                    : Carbon::parse($current_subscription->pivot->ends_at);
        $ends_at = $current_ends_at
                        ? now()->addWeeks($subscription->duration)
                        : Carbon::parse($current_subscription->pivot->ends_at)->addWeeks($subscription->duration);
        
        $next_subscription = [
            'name' => $subscription->name,
            'amount' => $subscription->amount,
            'starts_at' => formatedLocaleDate($starts_at),
            'ends_at' => formatedLocaleDate($ends_at),
        ];

        return view('front.subscriptions.renew', [
            'days_left' => $current_subscription->lastSubscriptionDaysLeft(),
            'next_subscription' => $next_subscription,
        ]);
    }

    public function renew(RequestSubscriptionRenewal $requestSubscriptionRenewal)
    {
        $type = $this->getNextSubscriptionType();
        $requestSubscriptionRenewal->send($type, Subscription::query()->findOrFail($type)->amount);

        auth()->user()->role_id = $type;
        auth()->user()->save();
        
        return redirect()->route('front.subscriber.subscriptions');
    }

    public function getNextSubscriptionType()
    {
        $user = auth()->user();
        if ($user->userable_type === 'App\Models\Company') {
            $type = 2;
        } elseif ($user->userable_type === 'App\Models\Talent') {
            if ($user->userable->talentable_type === 'App\Models\Student') {
                $type = 3;
            } elseif ($user->userable->talentable_type === 'App\Models\Pupil') {
                $type = 4;
            } else {
                $type = 5;
            }
        }
        return $type;
    }
}
