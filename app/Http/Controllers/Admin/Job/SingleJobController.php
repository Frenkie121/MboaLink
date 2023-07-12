<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use App\Models\Job;

class SingleJobController extends Controller
{
    public function show(Job $job)
    {
        return view('admin.jobs.show', [
            'job' => $job
        ]);
    }

    public function download(Job $job)
    {
        return response()->download(public_path('storage/jobs/' . $job->file));
    }

    public function listApplicants(Job $job)
    {
        return view('admin.jobs.applicants', [
            'job' => $job,
            'talents' => $job->load('talents.user')->talents,
        ]);
    }
}
