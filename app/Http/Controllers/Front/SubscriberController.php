<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{

    /**
     * Show jobs listing
     *
     * @return \Illuminate\Contracts\View\View
     * 
     */
    public function listJobs()
    {
        return view('front.subscribers.jobs-list', [

        ]);
    }
}
