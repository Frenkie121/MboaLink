<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Show profile details view
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

    /**
     * Show password edit view
     *
     * @return \Illuminate\Contracts\View\View
     * 
     */
    public function editPassword()
    {
        return view('front.subscribers.password', [
            'user' => auth()->user(),
        ]);
    }

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
