<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\{Job, User};
use Illuminate\Support\Facades\Notification;
use App\Notifications\Front\Jobs\ApplyJobNotification;

class ApplyJob extends Component
{
    public Job $job;

    public function mount(Job $job)
    {
        $this->job = $job;    
    }

    public function apply()
    {
        $user = auth()->user();
        abort_if(! in_array($user->role_id, [3, 4, 5, 6]), 403, trans('You cannot perform this action.'));

        $this->job->talents()->attach($user->userable->id);

        Notification::send([User::query()->firstWhere('role_id', 1), $user, $this->job->company->user], new ApplyJobNotification($this->job, $user->name));

        alert('', trans('Your application has been successfully submitted. You will receive an email confirming your action.'), 'success')->autoclose(10000);
        
        if ($user->role_id === 6) {
            $this->redirectRoute('front.jobs.show', $this->job->slug);
        } else {
            $this->redirectRoute('front.subscriber.jobs');
        }
    }

    public function render()
    {
        return view('livewire.front.apply-job');
    }
}
