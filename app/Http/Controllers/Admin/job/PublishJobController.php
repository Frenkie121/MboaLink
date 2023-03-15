<?php

namespace App\Http\Controllers\Admin\job;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class PublishJobController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Job $job)
    {
        return view('admin.jobs.show', ['job' => $job]);
    }
}
