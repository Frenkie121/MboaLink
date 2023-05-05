<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ValidateNotification;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTalent()
    {
        $subscribers = User::query()
                    ->withWhereHas('subscriptions')
                    ->with(['role'])
                    ->where('role_id', '>', 2)
                    ->get();

        return view('admin.subscribers.indexTalent', [ // talents than indexTalent
            'subscribers' =>  $subscribers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexCompany()
    {
        $subscribers = User::query()
                        ->withWhereHas('subscriptions')
                        ->with(['role'])
                        ->where('role_id',  2)
                        ->get();

        return view('admin.subscribers.indexCompany', [ // companies than indexCompany
            'subscribers' =>  $subscribers,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        return view(
            'admin.subscribers.profile',
            ['user' => $User]
        );
    }

    public function active(User $subscriber)
    {
        $subscription = $subscriber->subscriptions->last();
        $ends_at = now()->addWeeks($subscription->duration);
        // dd($week, $subscriber->subscriptions->last()->id);
        $subscriber->subscriptions()->updateExistingPivot($subscription->id, [
            'starts_at' => now(),
            'ends_at' => $ends_at
        ]);

        Notification::send($subscriber, new ValidateNotification($ends_at));

        toast(trans("The subscription has been successfully validated"), 'success');

        return back();
    }
}
