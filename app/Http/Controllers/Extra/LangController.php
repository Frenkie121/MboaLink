<?php

namespace App\Http\Controllers\Extra;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LangController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $locale) : RedirectResponse
    {
        app()->setlocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}