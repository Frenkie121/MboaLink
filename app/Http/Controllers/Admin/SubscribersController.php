<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use App\Notifications\Admin\ValidateSubscriptionNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;


class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTalent()
    {
        // $date=Carbon::parse(User::find(7)->subscriptions->last()->pivot->ends_at);
        // dd($date->format('Y,d,m'));
        $subscribers = User::query()
            ->withWhereHas('subscriptions')
            ->with(['role'])
            ->where('role_id', '>', 2)
            ->get();

        return view('admin.subscribers.Talents', [ // talents than indexTalent
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

        return view('admin.subscribers.Companies', [ // companies than indexCompany
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
       
        $subscriber->subscriptions()->updateExistingPivot($subscription->id, [
            'starts_at' => now(),
            'ends_at' => $ends_at
        ]);

        Notification::send($subscriber, new ValidateSubscriptionNotification(Carbon::parse($ends_at)));

        toast(trans("The subscription has been successfully validated"), 'success');

        return back();
    }
    public function download()
    {
        $url = Storage::download();
    }
}
