<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\SubCategory;

class JobController extends Controller
{
    public function index()
    {
        return view('front.jobs.index', [
            'types' => Job::TYPES,
            'jobs' => Job::query()
                        ->with('company:id,logo')
                        ->paginate(10),
        ]);
    }

    public function categories()
    {
        return view('front.jobs.categories', [
            'categories' => Category::query()
                                    ->paginate(8, ['slug', 'name']),

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
            'job' => $job->load('subCategory', 'company', 'tags'),
        ]);
    }
}
