<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Profile details view
     *
     * @return \Illuminate\Contracts\View\View
     * 
     */
    public function editProfile()
    {
        return view('front.subscribers.profile', [
            'user' => auth()->user(),
        ]);
    }
}
