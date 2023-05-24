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
        $this->job->talents()->attach($user->userable->id);

        Notification::send([User::query()->firstWhere('role_id', 1), $user, $this->job->company->user], new ApplyJobNotification($this->job, $user));

        alert('', trans('Your application has been successfully submitted. You will receive an email confirming your action.'), 'success')->autoclose(10000);
        
        if ($user->role_id === 6) {
            $this->redirectRoute('front.jobs', $this->job->slug);
        } else {
            $this->redirectRoute('front.subscriber.profile');
        }
    }

    public function render()
    {
        return view('livewire.front.apply-job');
    }
}
