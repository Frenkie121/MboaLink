<?php

namespace App\Http\Controllers\Admin\job;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Notifications\admin\job\PublishCompanyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PublishJobController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Job $job)
    {
        $job->where('id', $job->id)
            ->update([
                'published_at' => now(),
            ]);
        $message = trans('Job has been successfully published.');
        $data = trans('Congratulations, your job has been approved and published.');

        $job->save();
        Notification::send($job->company->user, new PublishCompanyNotification($job, $data));

        toast($message, 'success');

        return redirect()->route('admin.jobs.index');
    }
    public function show(Request $request, Job $job)
    {
        // dd($job);
        return view('admin.jobs.show', ['job' => $job]);
    }
}
