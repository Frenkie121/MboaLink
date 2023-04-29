<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $subscribersData = DB::table('subscription_user')->get();
        // dd($subscribersData);
        // foreach ($subscribersData as  $value) {

        // }

        $users = User::with(['role', 'subscriptions'])->get();

        $subscribers = [];
        foreach ($users as $user) {
            if (count($user->subscriptions) > 0) {
                $subscriber = $user;
                array_push($subscribers,  $subscriber);
            }
        }
        // dd($subscribers);->subscriptions()->first()
        // DB::table('subscription_user')->where('')
        // dd(User::find(2)->subscriptions->first()->pivot->starts_at);

        return view('admin.subscribers.index', [
            'subscribers' =>  $subscribers,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        // dd($User);
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
