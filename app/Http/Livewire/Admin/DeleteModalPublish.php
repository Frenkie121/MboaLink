<?php

namespace App\Http\Livewire\Admin;

use App\Models\Job;
use App\Notifications\publish\PublishCompanyNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class DeleteModalPublish extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $deleteId;

    public $title;

    protected $paginationTheme = 'bootstrap';

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteJob($id)
    {
    
        $this->deleteId = $id;
        $this->title = (Job::find($this->deleteId))->title;
    }

    public function notPublish()
    {
        $job = Job::find($this->deleteId);
        dd($this->deleteId,$job);
        $job->is_published = false;
        $message = trans("Job hasn't been successfully published.");
        $data = trans('Sorry, your job has not been approved and therefore not published.');
        Notification::send($job->company->user, new PublishCompanyNotification($job, $data));
        $this->alert('success', trans($message));
        $this->closeModal();
    }

    public function destroyJob()
    {
        DB::table('job_tag')->where('job_id', $this->deleteId)->delete();
        $message = trans("Job hasn't been successfully published.");
        $data = trans('Sorry, your job has not been approved and therefore not published.');
        $job = Job::find($this->deleteId);
        Notification::send($job->company->user, new PublishCompanyNotification($job, $data));
        dd('passer');
        $job->delete();
        $this->alert('success', trans('The job has been deleted'));
        $this->closeModal();

        return redirect()->route('admin.jobs.index');
    }

    public function render()
    {

        return view('livewire.admin.delete-modal-publish');
    }
}
