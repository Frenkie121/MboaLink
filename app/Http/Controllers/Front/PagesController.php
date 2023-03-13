<?php

namespace App\Http\Controllers\Front;

use App\Models\{Category, Job};
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

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
                                    ->whereHas('jobs', function (Builder $query) {
                                        $query->where('is_published', true);
                                    })
                                    ->withCount('jobs')
                                    ->get()
                                    ->take(8)
                                    ->sortByDesc('created_at'),                                    
        ]);
    }

    public function categories()
    {
        return view('front.jobs.categories', [
            'categories' => Category::query()
                                    ->whereHas('jobs', function (Builder $query) {
                                        $query->where('is_published', true);
                                    })
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
        ]);
    }
}
