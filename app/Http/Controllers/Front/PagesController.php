<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        return view('front.home');
    }
}
