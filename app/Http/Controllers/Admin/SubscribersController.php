<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{DB, Response, Notification};
use App\Notifications\Admin\ValidateSubscriptionNotification;

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
            ->withCount('subscriptions')
            ->with(['role'])
            ->where('role_id', '>=', 3)
            ->latest()
            ->get()
            ->filter(fn ($subscriber) => $subscriber->userable_type !== 'App\Models\Company');

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
            ->withCount('subscriptions')
            ->with(['role'])
            ->where('role_id',  2)
            ->orWhere('role_id', 6)
            ->latest()
            ->get()
            ->filter(fn ($subscriber) => $subscriber->userable_type === 'App\Models\Company');
            
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
        if ($subscriber->subscriptions->count() === 1) {
            $ends_at = now()->addWeeks($subscription->duration);

            $subscriber->subscriptions()->updateExistingPivot($subscription->id, [
                'starts_at' => now(),
                'ends_at' => $ends_at
            ]);
            
            $subscriber->is_active = true;
            $subscriber->save();
        } else {
            // Get the previous last subscription
            $subscriptions = DB::table('subscription_user')->where('user_id', $id)->get();
            $end_date = strval($subscriptions[$subscriptions->count() - 2]->ends_at);
            
            $starts_at = Carbon::parse($end_date)->isPast() ? now() : Carbon::parse($end_date);
            $ends_at = Carbon::parse($end_date)->isPast() ? now()->addWeeks($subscription->duration) : Carbon::parse($end_date)->addWeeks($subscription->duration);

            DB::table('subscription_user')->where('id', $subscriptions->last()->id)->update([
                'starts_at' => $starts_at,
                'ends_at' => $ends_at,
            ]);
        }

        $data = [
            'type' => __($subscription->name),
            'type_id' => $subscription->id,
            'created_at' => $subscription->pivot->created_at,
            'starts_at' => $starts_at ?? '',
            'ends_at' => $ends_at,
            'amount' => $subscription->amount,
        ];
        Notification::send($subscriber, new ValidateSubscriptionNotification($data));

        toast(trans("The subscription has been successfully validated"), 'success');

        return back();
    }

    public function download(User $user)
    {
        return response()->download(public_path("storage/cv/" . $user->userable->cv));
        // return Response::file(public_path("storage/cv/" . $user->userable->cv));
        // return Response::download(public_path("storage/cv/" . $user->userable->cv),  $user->slug);
        // return Storage::download(public_path("storage/cv/" . $user->userable->cv) , 'CV_' . $user->name);

    }

    public function listJobs(User $user)
    {
        $jobs = $user->role_id === 2
                ? $user->userable->jobs()->with('subCategory.category:name,id', 'talents')->latest()->get()
                : $user->userable->jobs()->with('subCategory.category:name,id')->latest()->get();

        return view('admin.subscribers.jobs', [
            'user' => $user,
            'jobs' => $jobs,
        ]);  
    }
}
