<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionBackController extends Controller
{
    public function index()
    {
        return view('admin.subscriptions.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'names.*' => ['required', 'distinct'],
            'duration' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'name_S' => ['required', 'string'],

        ], [
            'names.*' => "__('The name field is required.)",
        ]);
        dd($request);
    }
}
