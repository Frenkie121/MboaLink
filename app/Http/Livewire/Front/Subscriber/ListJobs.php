<?php

namespace App\Http\Livewire\Front\Subscriber;

use App\Models\User;
use Livewire\{Component, WithPagination};

class ListJobs extends Component
{
    use WithPagination;

    public function render()
    {
        $user = User::query()->findOrFail(auth()->id());
        $jobs = ($user->role_id === 2)
                ? $user->userable->jobs()->with('subCategory.category:name,id', 'talents')->latest()->paginate(5)
                : $user->userable->jobs()->with('subCategory.category:name,id')->latest()->paginate(5);
                // dd($jobs);
        return view('livewire.front.subscriber.list-jobs', [
            'jobs' => $jobs,
        ])
        ->layout('front.subscribers.main-layout', ['subtitle' => trans('Jobs list')]);
    }
}
