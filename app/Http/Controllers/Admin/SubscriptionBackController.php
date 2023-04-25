<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionBackController extends Controller
{
    public function index()
    {
        return view('admin.subscriptions.add');
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $data = $request->validate([
            'offers.*' => ['required', 'string', 'distinct'],
            'offers_add.*' => ['required', 'string', 'distinct', 'different:offers.*'],
            'subs_name' => ['required', 'string', 'unique:subscriptions,name,' . $id],
            'amount' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'numeric', 'min:0', 'max:12'],

        ], [
            'offers_add.*.different' => __('The new offer :position and current offers must be different')
        ]);
        $subscription = Subscription::find($id);
        $subscription->update([
            'name' => $data['subs_name'],
            'slug' => Str::slug($data['subs_name']),
            'amount' => $data['amount'],
            'duration' => $data['duration'],
        ]);
        $subscription->offers()->delete();
        // field existing
        foreach ($data['offers'] as  $value) {
            $subscription->offers()->create(['content' => $value]);
        }
        // new field whom adding
        if (isset($data['offers_add'])) {
            foreach ($data['offers_add'] as  $value) {
                $subscription->offers()->create(['content' => $value]);
            }
        }

        toast(trans('The Subscription has been updated'), 'success');

        return redirect()->route('admin.subscription.index');
    }
}
