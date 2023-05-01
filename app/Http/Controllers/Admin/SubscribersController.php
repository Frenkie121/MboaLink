<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\ProfileSubscriber\SuscriptionList;

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
