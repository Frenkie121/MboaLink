<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{Category, Job, SubCategory, Subscription};

class PagesController extends Controller
{
    public function home()
    {
        return view('front.pages.home', [
            'jobs' => Job::query()
                        ->with('company:id,logo')
                        ->published()
                        ->get()
                        ->take(5)
                        ->sortByDesc('created_at'),
            'categories' => Category::query()
                                    ->hasJobs()
                                    ->withCount('jobs')
                                    ->get()
                                    ->take(8)
                                    ->sortByDesc('created_at'),

            'subCategories' => SubCategory::query()
                                        ->hasJobs()
                                        ->get('name'),
            'types' => Job::TYPES,
            'subscriptions' => Subscription::query()
                                        ->with(['offers:id,content,subscription_id'])
                                        ->get(['id', 'name', 'slug', 'amount'])
                                        ->take(3),
        ]);
    }

    public function categories()
    {
        return view('front.jobs.categories', [
            'categories' => Category::query()
                                    ->hasJobs()
                                    ->withCount('jobs')
                                    ->latest()
                                    ->paginate(8),

        ]);
    }

    public function jobsByCategory(Category $category)
    {
        $sub_categories_ids = $category->subCategories()->pluck('id');
        $jobs = Job::query()
                    ->with(['company'])
                    ->whereIn('sub_category_id', $sub_categories_ids)
                    ->latest()
                    ->paginate(10);

        return view('front.jobs.index', [
            'jobs' => $jobs,
            'subCategories' => SubCategory::query()
                                            ->hasJobs()
                                            ->get('name'),
            'types' => Job::TYPES,
        ]);
    }
}
