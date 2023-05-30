<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{Job, SubCategory};
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
        abort_if(
            auth()->user()->userable_type !== 'App\Models\Company',
            403,
        );

        return view('front.jobs.create', [
            'types' => Job::TYPES,
            'subCategories' => SubCategory::query()
                                            ->get(),
        ]);
    }

    public function show(Job $job)
    {
        if ((is_null($job->published_at) && in_array(auth()->user()->role_id, [1, 2])) || $job->published_at) {
            return view('front.jobs.show', [
                'types' => Job::TYPES,
                'job' => $job->load([
                    'subCategory.category',
                    'company.user.userable:id,location',
                    'tags',
                    'requirements:id,content,job_id',
                    'qualifications:id,content,job_id',
                ]),
            ]);
        }
        toast(trans('This job has not been published yet.'), 'error');
        return redirect()->route('front.jobs.index');
    }

    public function search(Request $request)
    {
        $search = '%'.$request->search.'%';
        $sub_category = $request->sub_category;
        $type = $request->type;

        if (! $request->search && ! $sub_category && ! $type) {
            $jobs = collect();
        } else {
            $jobs = Job::query()
            ->when($request->search, fn (Builder $query) => $query->orWhere('title', 'LIKE', $search)
                        ->orWhere('description', 'LIKE', $search)
            )
            ->when($sub_category, function (Builder $query) use ($sub_category) {
                return $query->orWhere('sub_category_id', SubCategory::query()->firstWhere('name', $sub_category)->id);
            })
            ->when(in_array($type, Job::TYPES), fn (Builder $query) => $query->orWhere('type', array_search($type, Job::TYPES))
            )
            ->published()
            ->active()
            ->with('company:id,logo')
            ->orderByDesc('created_at')
            ->get();
        }

        return view('front.jobs.index', [
            'jobs' => $jobs,
            'types' => Job::TYPES,
            'subCategories' => SubCategory::query()
                                        ->has('jobs')
                                        ->get('name'),
        ]);
    }
}
