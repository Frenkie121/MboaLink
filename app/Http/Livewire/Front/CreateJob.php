<?php

namespace App\Http\Livewire\Front;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\{Component, WithFileUploads};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\{Category, Company, Job, Tag, User};

class CreateJob extends Component
{
    use WithFileUploads, LivewireAlert;

    public $currentStep = 1;

    public $categories;
    public $sub_categories;
    public $all_tags;
    public $types;

    // General job informations properties
    public $title, $location, $min_salary, $max_salary, $category, $sub_category, $type, $dateline, $description, $file, $tags;

    // Requirements
    public $requirements;
    public array $requirementsInputs = [];
    public int $i = 1;

    // Qualifications
    public $qualifications;
    public array $qualificationsInputs = [''];

    // Company Details
    public $name, $email, $website, $company_location, $company_description, $logo;

    protected $listeners = [
        'confirmCancel'
    ];

    public function mount()
    {
        $this->categories = Category::query()->with('subCategories:id,name,category_id')->get(['id', 'name']);
        $this->all_tags = Tag::query()->get(['id', 'name']);
        $this->types = Job::TYPES;
        $this->sub_categories = collect();
    }

    /**
     * Navigate in form wizard from one step to another
     *
     * @param int $step
     * 
     * @return void
     * 
     */
    public function previous(int $step): void
    {
        $this->currentStep = $step;
    }

    // STEP I

    /**
     * Lifecyle hook to update category property and get related subCategories on every change
     *
     * @param string $category
     * 
     * @return void
     * 
     */
    public function updatedCategory($category): void
    {
        if (! is_null($category) && is_integer(intval($category))) {
            $this->sub_categories = Category::query()->findOrFail($category)->subCategories;
        }
    }

    /**
     * Validate first step form containing job general infromations
     *
     * @return void
     * 
     */
    public function validateGeneralInformations(): void
    {
        $this->validate([
            'title' => 'required|string|max:100',
            'location' => 'required|string|max:50',
            'min_salary' => 'required|numeric',
            'max_salary' => 'nullable|numeric|gt:min_salary',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'type' => 'required|' . Rule::in(array_keys($this->types)),
            'dateline' => 'required|date|after:' . now()->addWeek(),
            'description' => 'required|string|max:1000',
            'file' => 'nullable|file|mimes:doc,docx,pdf,ppt|max:512',
            'tags' => 'nullable|array',
            'tags.*' =>'nullable|exists:tags,id',
        ]);

        $this->currentStep = 2;
    }

    // STEP II : Validate Requirements

    /**
     * Add new element to inputs array to increase requirements inputs
     *
     * @param int $i
     * 
     * @return void
     * 
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
     *
     * @param int $i
     * 
     * @return void
     * 
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
     *
     * @return void
     * 
     */
    public function validateRequirements(): void
    {
        $this->validate([
            'requirements.0' => 'required|string|max:200',
            'requirements.*' => 'required|string|distinct|max:200',
        ]);

        $this->currentStep = 3;
    }

    // STEP III

    public function removeQualification($index): void
    {
        unset($this->qualificationsInputs[$index]);
        $this->qualificationsInputs = array_values($this->qualificationsInputs);
    }

    /**
     * Validate qualifications fields
     *
     * @return void
     * 
     */
    public function validateQualifications(): void
    {
        $this->validate([
            'qualifications.0' => 'required|string|max:200',
            'qualifications.*' => 'nullable|string|distinct|max:200',
        ]);

        $this->currentStep = 4;
    }

    // STEP IV

    /**
     * Validate company details fields
     *
     * @return void
     * 
     */
    public function validateCompanyDetails(): void
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'website' => 'nullable|url',
            'company_location' => 'nullable|string|max:50',
            'company_description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|max:512',
        ]);

        $this->currentStep = 5;
    }

    // STEP V

    /**
     * Save fields to database
     *
     * @return void
     * 
     */
    public function confirm(): void
    {       
        // I. SAVES

        // 1. Company
        $company = Company::query()->create([
            'location' => $this->company_location,
            'description' => $this->company_description,
            'url' => $this->website ?? '',
        ]);

        // 2. User
        $company->user()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Str::random(),
            'role_id' => 2,
        ]);

        // 3. Job
        $salary = $this->min_salary . $this->max_salary ? '  - ' . $this->min_salary : ''; 
        $job = $company->jobs()->create([
            'sub_category_id' => $this->sub_category,
            'title' => $this->title,
            'location' => $this->location,
            'description' => $this->description,
            'salary' => $salary,
            'type' => $this->type,
            'dateline' => $this->dateline,
        ]);

        if ($this->file) {
            $filename = $job->slug . '_' . uniqid() . $this->file->extension();
            $this->file->storeAs('public/jobs', $filename);
        }

        // 4. Tags
        if ($this->tags) {
            foreach ($this->tags as $tag) {
                $job->tags()->attach($tag);
            }
        }

        // 5. Requirements
        foreach ($this->requirements as $requirement) {
            $job->requirements()->create(['content' => $requirement]);
        }

        // 6. Qualifications
        foreach ($this->qualifications as $qualification) {
            $job->qualifications()->create(['content' => $qualification]);
        }

        // II. MAILS

        // 1. To Admin

        // 2. To User - Company

        // 
        alert('', trans('Your job has been successfully registered. It will be studied and you will be informed of its publication or not as soon as possible. An email related to this action has been sent to you, please check your mailbox.'), 'success')->autoclose(10000);

        $this->redirectRoute('front.jobs.create');
    }

    /**
     * Show alert for job cancellation
     *
     * @return void
     * 
     */
    public function cancel(): void
    {
        $this->alert('question', trans('Are you sure you want to cancel?'), [
            'showConfirmButton' => true,
            'confirmButtonText' => trans('Yes'),
            'onConfirmed' => 'confirmCancel',
            'showCancelButton' => true,
            'cancelButtonText' => trans('No'),
            'confirmButtonColor' => '#f9460c',
            'timer' => null,
        ]);
    }

    /**
     * Confirm job cancellation
     *
     * @return void
     * 
     */
    public function confirmCancel(): void
    {
        $this->reset();
        $this->flash('success', trans('Job creation has been cancelled'), ['timer' => 5000], 'jobs/create');
    }

    public function render()
    {
        return view('livewire.front.create-job');
    }
}
