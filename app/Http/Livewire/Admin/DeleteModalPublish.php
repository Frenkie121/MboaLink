<?php

namespace App\Http\Livewire\Admin;

use App\Models\Job;
use App\Notifications\admin\job\PublishCompanyNotification;
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

    public $job;

    public $title;

    protected $paginationTheme = 'bootstrap';

    public function closeModal()
    {
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
        return redirect()->route('admin.jobs.index');
    }

    public function deleteJob($id)
    {
        $this->deleteId = $id;
        $this->title = (Job::find($this->deleteId))->title;
    }

    public function destroyJob()
    {
        DB::table('job_tag')->where('job_id', $this->deleteId)->delete();
        DB::table('qualifications')->where('job_id', $this->deleteId)->delete();
        DB::table('requirements')->where('job_id', $this->deleteId)->delete();
        $message = trans("Job hasn't been successfully published.");
        $data = trans('Sorry, your job has not been approved and therefore not published.');
        $job = Job::find($this->deleteId);
        Notification::send($job->company->user, new PublishCompanyNotification($job, $data));
        $job->delete();

        $this->closeModal();
        $this->reset();

        $this->alert('success', $message);

        return redirect()->route('admin.jobs.index');
    }

    public function render()
    {
        return view('livewire.admin.delete-modal-publish');
    }
}
