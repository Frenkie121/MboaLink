<?php

namespace App\Http\Livewire\Front\Subscriber;

use App\Models\{Job, Subscription, Talent, User};
use Livewire\Component;
use Livewire\WithPagination;

class ListApplications extends Component
{
    use WithPagination;

    public $job;

    public $selectedTalent, $user;

    public function mount($job)
    {
        $this->job = Job::query()->where('slug', $job)->first();
    }

    public function showTalentModal(int $talentId)
    {
        $this->reset(['selectedTalent']);
        $this->selectedTalent = Talent::query()->find($talentId);
        $this->user = $this->selectedTalent->user;
        $this->emit('openModal');
    }

    public function downloadCV()
    {
        return response()->download(public_path("storage/cv/" . $this->user->userable->cv));
    }

    public function render()
    {
        return view('livewire.front.subscriber.list-applications', [
            'talents' => $this->job->talents()->with('user.role:id,name')->paginate(5),
        ])
        ->layout('front.subscribers.main-layout', ['subtitle' => trans('Job applicants')]);
    }
}
