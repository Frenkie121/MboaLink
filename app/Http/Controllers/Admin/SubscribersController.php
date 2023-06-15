<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Admin\ValidateSubscriptionNotification;
use PhpParser\Node\Stmt\Return_;

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
            ->latest()
            ->get();

        return view('admin.subscribers.talents', [
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
            ->oldest()
            ->get();

        return view('admin.subscribers.companies', [
            'subscribers' =>  $subscribers,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view(
            'admin.subscribers.profile',
            ['user' => $user]
        );
    }
    /**
     *this function will active a subscription of  user
     */
    public function active($id)
    {
        $subscriber = User::find($id);
        $subscription = $subscriber->subscriptions->last();
        $ends_at = now()->addWeeks($subscription->duration);

        $subscriber->subscriptions()->updateExistingPivot($subscription->id, [
            'starts_at' => now(),
            'ends_at' => $ends_at
        ]);
        
        $subscriber->is_active = true;
        $subscriber->save();

        $data = [
            'type' => __($subscription->name),
            'created_at' => $subscription->pivot->created_at,
            'ends_at' => $ends_at,
        ];
        Notification::send($subscriber, new ValidateSubscriptionNotification($data));

        toast(trans("The subscription has been successfully validated"), 'success');

        return back();
    }
    public function download(User $user)
    {
        return Response::file(public_path("storage/cv/" . $user->userable->cv));
        // return Response::download(public_path("storage/cv/" . $user->userable->cv),  $user->slug);
        // return Storage::download(public_path("storage/cv/" . $user->userable->cv) , 'CV_' . $user->name);

    }
}
