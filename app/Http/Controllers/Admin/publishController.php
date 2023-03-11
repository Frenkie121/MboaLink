<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\publish\PublishCompanyNotification;
use App\Notifications\publish\PublishCompanyFrNotification;

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
            $data = trans(' Sorry, your job has not been approved and therefore not published.');
        } else {
            $job->is_published = true;
            $message = trans('Job has been successfully published.');
            $data = trans('Congratulations, your job has been approved and published.');
        }
        $job->save();
        if (App::isLocale('en')) {
            Notification::send($job->company->user, new PublishCompanyNotification($job, $data));
        } else {
            Notification::send($job->company->user, new PublishCompanyFrNotification($job, $data));
        }
        toast($message, 'success');
        return redirect()->back();
    }
}
