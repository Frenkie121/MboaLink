<?php

namespace App\Http\Livewire\Front;

use App\Models\{Category, Job, Tag};
use Illuminate\Validation\Rule;
use Livewire\{Component, WithFileUploads};

class CreateJob extends Component
{
    use WithFileUploads;

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
            'file' => 'nullable|file|mimes:doc,docx,pdf,ppt',
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
            'logo' => 'nullable|image',
        ]);

        $this->currentStep = 5;
    }

    public function render()
    {
        return view('livewire.front.create-job');
    }
}
