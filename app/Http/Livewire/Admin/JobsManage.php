<?php

namespace App\Http\Livewire\Admin;

use App\Models\Job;
use Livewire\{Component, WithPagination};
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Notifications\admin\Job\PublishCompanyNotification;

class JobsManage extends Component
{
    use LivewireAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function publish(Job $job)
    {
        $job->update(['published_at' => now()]);

        $message = trans('Job has been successfully published.');
        $data = trans('Congratulations, your job has been approved and published.');

        // $job->save();
        Notification::send($job->company->user, new PublishCompanyNotification($job, $data));

        toast($message, 'success');
    }

    public function render()
    {
        return view('livewire.admin.jobs-manage', [
            'jobs' => Job::query()->with('company')->latest()->paginate(10)
        ]);
    }
}
