<?php

namespace App\Http\Livewire\Front;

use App\Http\Requests\JobRequest;
use App\Models\{Category, Job, Tag, User};
use Livewire\{Component, WithFileUploads};
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Notifications\Front\Jobs\PostJobNotification;

class CreateJob extends Component
{
    use WithFileUploads, LivewireAlert;

    public $currentStep = 1;

    public $categories, $sub_categories, $all_tags, $types;

    // General job informations properties
    public $title, $min_salary, $max_salary, $category, $sub_category, $type, $dateline, $description, $file, $tags;

    // Requirements
    public $requirements;
    public array $requirementsInputs = [];

    public int $i = 1;

    // Qualifications
    public $qualifications;
    public array $qualificationsInputs = [];

    // Confirmation
    public $selectedTags;
    // Other
    // public bool $disabled = false;

    protected $listeners = [
        'confirmCancel',
    ];

    public function mount()
    {
        $this->all_tags = Tag::query()->get(['id', 'name']);
        $this->types = Job::TYPES;
        $this->sub_categories = collect();
        $this->categories = Category::query()
                                    ->with('subCategories:id,name,category_id')
                                    ->oldest('name')
                                    ->enabled()
                                    ->get(['id', 'name']);
    }

    /**
     * Navigate in form wizard from one step to another
     */
    public function previous(): void
    {
        $this->currentStep--;
    }

    // STEP I

    /**
     * Lifecyle hook to update category property and get related subCategories on every change
     *
     * @param  string  $category
     */
    public function updatedCategory($category): void
    {
        if (! is_null($category) && is_int(intval($category))) {
            $this->sub_categories = Category::query()
                                            ->findOrFail($category)
                                            ->subCategories()
                                            ->enabled()
                                            ->oldest('name')
                                            ->get();
        }
    }

    /**
     * Validate first step form containing job general infromations
     */
    public function validateGeneralInformations(): void
    {
        $this->validate((new JobRequest())->rules(1));

        $this->currentStep = 2;
    }

    // STEP II : Validate Requirements

    /**
     * Add new element to inputs array to increase requirements inputs
     */
    public function add(int $i): void
    {
        $i++;
        $this->i = $i;
        if ($this->currentStep === 2) {
            array_push($this->requirementsInputs, $i);
        } else {
            array_push($this->qualificationsInputs, $i);
        }
    }

    /**
     * Remove element from in array which will delete a requirement input
     */
    public function remove(int $i): void
    {
        if ($this->currentStep === 2) {
            unset($this->requirementsInputs[$i]);
        } else {
            unset($this->qualificationsInputs[$i]);
        }
    }

    /**
     * Validate requirements fields and go to the next step
     */
    public function validateRequirements(): void
    {
        $this->validate((new JobRequest())->rules(2));
        
        $this->currentStep = 3;
    }
    
    // STEP III
    
    /**
     * Validate qualifications fields
     */
    public function validateQualifications(): void
    {
        $this->validate((new JobRequest())->rules(3));

        $this->currentStep = 4;
    }

    // STEP IV

    /**
     * Save fields to database
     */
    public function confirm(): void
    {
        // I. SAVES
        // 1. Job
        $salary = $this->max_salary ? $this->min_salary.' - '.$this->max_salary : $this->min_salary;
        $user = User::find(auth()->id());
        $job = $user->userable->jobs()->create([
            'sub_category_id' => $this->sub_category,
            'title' => $this->title,
            'description' => $this->description,
            'salary' => $salary,
            'type' => $this->type,
            'dateline' => $this->dateline,
        ]);
        
        if ($this->file) {
            $filename = $job->slug . '.' . $this->file->extension();
            $this->file->storeAs('public/jobs', $filename);
            $job->file = $filename;
            $job->save();
        }

        // 2. Tags
        if ($this->tags) {
            foreach ($this->tags as $tag) {
                $job->tags()->attach($tag);
            }
        }

        // 3. Requirements
        foreach ($this->requirements as $requirement) {
            $job->requirements()->create(['content' => $requirement]);
        }

        // 4. Qualifications
        foreach ($this->qualifications as $qualification) {
            $job->qualifications()->create(['content' => $qualification]);
        }

        // II. MAILS
        Notification::send([User::query()->firstWhere('role_id', 1), $user], new PostJobNotification($job));

        alert('', trans('Your job has been successfully registered. It will be studied and you will be informed of its publication or not as soon as possible. An email related to this action has been sent to you, please check your mailbox.'), 'success')->autoclose(20000);

        $redirect = $user->role_id === 2 ? 'front.subscriber.jobs' : 'front.jobs.index';
        $this->redirectRoute($redirect);
    }

    /**
     * Show alert for job cancellation
     */
    public function cancel(): void
    {
        $this->alert('question', trans('Are you sure you want to cancel?'), [
            'position' => 'center',
            'timer' => null,
            'toast' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => trans('Yes'),
            'onConfirmed' => 'confirmCancel',
            'confirmButtonColor' => '#f9460c',
            'showCancelButton' => true,
            'cancelButtonText' => trans('No'),
            'width' => 400,
        ]);
    }

    /**
     * Confirm job cancellation
     */
    public function confirmCancel(): void
    {
        alert('', trans('Job creation has been cancelled'), 'info')->autoclose(7000);
        $this->redirectRoute('front.jobs.create');
    }

    public function render()
    {
        return view('livewire.front.create-job');
    }
}
