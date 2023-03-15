<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('front.jobs.index', [
            'types' => Job::TYPES,
            'jobs' => Job::query()
                        ->published()
                        ->active()
                        ->with('company:id,logo')
                        ->orderByDesc('created_at')
                        ->paginate(10),
            'subCategories' => SubCategory::query()
                        ->has('jobs')
                        ->get('name'),
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
                'subCategory.category',
                'company.user:id,name,email,userable_id',
                'tags',
                'requirements:id,content,job_id',
                'qualifications:id,content,job_id',
            ]),
        ]);
    }

    public function search(Request $request)
    {
        $search = '%' . $request->search . '%';
        $sub_category = $request->sub_category;
        $type = $request->type;
        
        $jobs = Job::query()
            ->when($request->search, fn (Builder $query)
                => $query->orWhere('title', 'LIKE', $search)
                        ->orWhere('description','LIKE',  $search)
            )
            ->when($sub_category, function (Builder $query) use ($sub_category) {
                return $query->orWhere('sub_category_id', SubCategory::query()->firstWhere('name', $sub_category)->id);
            })
            ->when($type, fn (Builder $query)
                => $query->orWhere('type', array_search($type, Job::TYPES))
            )
            ->published()
            ->active()
            ->with('company:id,logo')
            ->orderByDesc('created_at')
            ->get();

        return view('front.jobs.index', [
            'jobs' => $jobs,
            'types' => Job::TYPES,
            'subCategories' => SubCategory::query()
                                        ->has('jobs')
                                        ->get('name'),
        ]);
    }
}
