<?php

namespace App\Http\Controllers\Front;

use App\Models\{Subscription};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class SubscriptionController extends Controller
{
    /**
     * Display listing subscription plans
     *
     * @return \Illuminate\Contracts\View\View
     * 
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
}
