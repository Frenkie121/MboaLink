<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\publish\PublishCompanyNotification;

class publishController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Job $job)
    {
        if ($job->is_published) {
            $job->is_published = false;
            $message = trans("Job hasn't been successfully published.");
        } else {
            $job->is_published = true;
            $message = trans('Job has been successfully published.');
        }
        $job->save();
        dd($job->company->user);
        // if (App::isLocale('en')) {
        Notification::send($job->company->email, new PublishCompanyNotification($job));
        // $this->notify(new PublishCompanyNotification($job, $job->company));
        // } else {
        //     $this->notify(new ResetPasswordFrNotification($token));
        // }
        toast($message, 'success');

        return redirect()->back();
    }
}
