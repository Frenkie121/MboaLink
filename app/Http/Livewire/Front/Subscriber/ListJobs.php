<?php

namespace App\Http\Livewire\Front\Subscriber;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListJobs extends Component
{
    use WithPagination;

    public function render()
    {
        $user = User::query()->findOrFail(auth()->id());

        return view('livewire.front.subscriber.list-jobs', [
            'jobs' => $user->userable->jobs()->with('subCategory.category:name,id')->latest()->paginate(5),
        ])
        ->layout('front.subscribers.main-layout', ['subtitle' => trans('Jobs list')]);
    }
}
