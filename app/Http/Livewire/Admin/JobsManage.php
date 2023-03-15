<?php

namespace App\Http\Livewire\Admin;

use App\Models\Job;
use App\Notifications\admin\job\PublishCompanyNotification;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class JobsManage extends Component
{
    use WithPagination;
    use LivewireAlert;

    // public $deleteId;

    // public $title;

    // // public $deleteJob;

    // public $location;

    // public $salary;

    // public $company;

    // public $sub_category;

    // public $description;

    // public $dateline;

    // public $created_at;
    // public Job $job;

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
        $job->where('id', $job->id)
            ->update([
                'published_at' => now(),
            ]);
        $message = trans('Job has been successfully published.');
        $data = trans('Congratulations, your job has been approved and published.');

        $job->save();
        Notification::send($job->company->user, new PublishCompanyNotification($job, $data));

        toast($message, 'success');
    }

    public function render()
    {
        return view('livewire.admin.jobs-manage', ['jobs' => Job::query()->with('company')->latest()->paginate(5)]);
    }
}
