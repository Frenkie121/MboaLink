<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('front.jobs.index', [
            'jobs' => Job::query()
                        ->get()
        ]);
    }

    public function create()
    {
        return view('front.jobs.create', [
            'types' => Job::TYPES,
            'subCategories' => SubCategory::query()
                                            ->get()
        ]);
    }

    public function show(Job $job)
    {
        return view('front.jobs.show', [
            'job' => $job->load('subCategory', 'company', 'tags')
        ]);
    }
}
