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

    // general job informations properties
    public $title, $location, $min_salary, $max_salary, $category, $sub_category, $type, $dateline, $description, $file, $tags;

    public function mount()
    {
        $this->categories = Category::query()->with('subCategories:id,name,category_id')->get(['id', 'name']);
        $this->all_tags = Tag::query()->get(['id', 'name']);
        $this->types = Job::TYPES;
        $this->sub_categories = collect();
    }

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
        if (! is_null($category)) {
            $this->sub_categories = Category::query()->findOrFail($category)->subCategories;
        }
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
            'location' => 'required|string',
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

    public function render()
    {
        return view('livewire.front.create-job');
    }
}
