<?php

namespace App\Http\Controllers\Front;

use App\Models\Job;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function index()
    {
        return view('front.jobs.index', [
            'types' => Job::TYPES,
            'jobs' => Job::query()
                        ->with('company:id,logo')
                        ->orderByDesc('created_at')
                        ->paginate(10),
        ]);
    }

    public function create()
    {
        return view('front.jobs.create', [
            'types' => Job::TYPES,
            'subCategories' => SubCategory::query()
                                            ->get(),
        ]);
    }

    public function show(Job $job)
    {
        return view('front.jobs.show', [
            'types' => Job::TYPES,
            'job' => $job->load([
                'subCategory',
                'company',
                'tags',
                'requirements:id,content,job_id',
                'qualifications:id,content,job_id',
            ]),
        ]);
    }
}
