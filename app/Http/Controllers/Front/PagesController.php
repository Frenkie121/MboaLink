<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;

class PagesController extends Controller
{
    public function home()
    {
        return view('front.home');
    }

    public function categories()
    {
        return view('front.categories', [
            'categories' => Category::query()
                                    // ->with('')
                                    ->paginate(8, ['slug', 'name']),

        ]);
    }
}
