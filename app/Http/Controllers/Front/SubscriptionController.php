<?php

namespace App\Http\Controllers\Front;

use App\Models\{Subscription};
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function pricing()
    {
        return view('front.subscriptions.pricing', [
            'subscriptions' => Subscription::query()
                                        ->with(['offers:id,content,subscription_id'])
                                        ->get(['id', 'name', 'slug', 'amount']),
        ]);
    }   
}
