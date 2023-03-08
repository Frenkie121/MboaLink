<?php

namespace App\Http\Controllers\Front;

use App\Models\{Category, Job};
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class PagesController extends Controller
{
    public function home()
    {
        return view('front.home', [
            'jobs' => Job::query()
                        ->with('company:id,logo')
                        ->get()
                        ->where('is_published', true)
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
}
