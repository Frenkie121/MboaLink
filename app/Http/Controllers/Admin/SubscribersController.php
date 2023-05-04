<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Http\Livewire\Admin\ProfileSubscriber\SuscriptionList;
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
        $users = User::with(['role', 'subscriptions'])->where('role_id', '>', 2)->get();

        $subscribers = [];
        foreach ($users as $user) {
            if (count($user->subscriptions) > 0) {
                $subscriber = $user;
                array_push($subscribers,  $subscriber);
            }
        }

        return view('admin.subscribers.indexTalent', [
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
        $users = User::with(['role', 'subscriptions'])->where('role_id',  2)->get();

        $subscribers = [];
        foreach ($users as $user) {
            if (count($user->subscriptions) > 0) {
                $subscriber = $user;
                array_push($subscribers,  $subscriber);
            }
        }


        return view('admin.subscribers.indexCompany', [
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

    public function Active(User $subscriber)
    {

        $week = $subscriber->subscriptions->last()->duration;
        // dd($week, $subscriber->subscriptions->last()->id);
        foreach ($subscriber->subscriptions->last()->users()->get() as $user) {
            if ($user->id === $subscriber->id) {
                DB::table('subscription_user')->where([
                    "user_id" => $subscriber->id,
                    "subscription_id" => $subscriber->subscriptions->last()->id,
                ])->update([
                    'starts_at' => now(),
                    'ends_at' => now()->addWeeks($week)
                ]);
            }
        }


        Notification::send($subscriber, new ValidateNotification(now()->addWeeks($week)));

        toast(trans("The subscription has been successfully validated"), 'success');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
