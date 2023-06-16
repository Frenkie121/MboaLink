<?php

namespace App\Http\Livewire\Admin;

use App\Models\Job;
use App\Notifications\admin\Job\PublishCompanyNotification;
use Illuminate\Support\Facades\{DB, Notification};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\{Component, WithPagination};

class DeleteModalPublish extends Component
{
    use LivewireAlert, WithPagination;

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
        $job->published_at = now();
        $job->save();

        $data = trans('Congratulations, your job has been approved and published.');

        Notification::send($job->company->user, new PublishCompanyNotification($job, $data));

        toast(__('Job has been successfully published.'), 'success');

        return redirect()->route('admin.job.show', $job);
    }

    public function deleteJob($id)
    {
        $this->deleteId = $id;
        $this->title = (Job::find($this->deleteId))->title;
    }

    public function destroyJob()
    {
        $job = Job::query()->findOrFail($this->deleteId);
        // DB::table('job_tag')->where('job_id', $this->deleteId)->delete();
        $job->tags()->detach();
        // DB::table('qualifications')->where('job_id', $this->deleteId)->delete();
        $job->qualifications()->delete();
        // DB::table('requirements')->where('job_id', $this->deleteId)->delete();
        $job->requirements()->delete();

        $data = trans('Sorry, your job has not been approved and therefore not published.');
        Notification::send($job->company->user, new PublishCompanyNotification($job, $data));
        $job->delete();

        toast(__('Job has been successfully deleted'), 'success');

        return redirect()->route('admin.jobs.index');
    }

    public function export()
    {
        return response()->download(public_path('storage/jobs/' . $this->job->file));
    }

    public function render()
    {
        return view('livewire.admin.delete-modal-publish');
    }
}
