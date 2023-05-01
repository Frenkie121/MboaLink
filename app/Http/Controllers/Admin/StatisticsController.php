<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $Enablejobs = 0;
        $jobs = Job::all();
        foreach ($jobs as $job) {
            if ($job->published_at) {
                ++$Enablejobs;
            }
        }
        $subscribers = 0;
        $users = count(User::all());
        foreach (User::with(['role', 'subscriptions'])->get() as $user) {
            if (count($user->subscriptions) > 0) {
                $subscribers++;
            }
        }
        return view('admin.dashboard', [
            'subscribers' => $subscribers,
            'users' => $users,
            'enableJobs' => $Enablejobs,
            'jobs' => Count(Job::get()),
        ]);
    }
}
