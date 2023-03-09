<?php

namespace App\Http\Livewire;

use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class JobsManage extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $deleteId;

    public $title;

    // public $deleteJob;

    public $location;

    public $salary;

    public $company;

    public $sub_category;

    public $description;

    public $dateline;

    public $created_at;

    protected $paginationTheme = 'bootstrap';

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteJob($id)
    {
        $this->deleteId = $id;
        $this->title = (Job::find($this->deleteId))->title;
    }

    public function destroyJob()
    {
        DB::table('job_tag')->where('job_id', $this->deleteId)->delete();
        (Job::find($this->deleteId))->delete();
        $this->alert('success', trans('The job has been deleted'));
        $this->closeModal();
    }

    public function showJob($id)
    {
        $this->title = (Job::find($id))->title;
        $this->location = (Job::find($id))->location;
        $this->salary = (Job::find($id))->salary;
        $this->company = (Job::find($id))->company;
        $this->sub_category = (Job::find($id))->subCategory;
        $this->description = (Job::find($id))->description;
        $this->dateline = (Job::find($id))->dateline;
        $this->created_at = (Job::find($id))->reated_at;
    }

    public function render()
    {
        return view('livewire.jobs-manage', ['jobs' => Job::query()->with('company')->latest()->paginate(5)]);
    }
}
