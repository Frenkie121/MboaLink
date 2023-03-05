<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ManageSubCategories extends Component
{
    use WithPagination, LivewireAlert;

    public $selectedSubCategory;

    public $name;
    public $category;

    protected $rules = [
        'name' => 'required|unique:sub_categories,name',
        'category' => 'required|exists:categories,id'
    ];

    public function showCreateForm()
    {
        $this->reset();
        $this->emit('openModal');
    }

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('closeModal');
    }

    public function store()
    {
        $this->validate();
        SubCategory::query()
                    ->create([
                        'name' => $this->name,
                        'category_id' => $this->category
                    ]);

        $this->closeModal();

        $this->alert('success', trans('The sub-category has been created'), [
            'showCloseButton' => true
        ]);
    }

    public function showEditForm(SubCategory $subCategory)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->selectedSubCategory = $subCategory;

        $this->name = $subCategory->name;
        $this->category = $subCategory->category->id;

        $this->emit('openModal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:sub_categories,name,' . $this->selectedSubCategory->id,
            'category' => 'required|exists:categories,id'
        ]);

        $this->selectedSubCategory->update([
            'name' => $this->name,
            'category_id' => $this->category
        ]);

        $this->closeModal();

        $this->alert('success', trans('The sub-category has been updated'), [
            'showCloseButton' => true
        ]);
    }

    public function showDeleteModal(SubCategory $subCategory)
    {
        $this->selectedSubCategory = $subCategory;

        $this->emit('openDeleteModal');
    }

    public function confirmDelete()
    {
        $this->selectedSubCategory->delete();

        $this->closeModal();

        $this->alert('success', trans('The sub-category has been deleted'), [
            'showCloseButton' => true
        ]);
    }

    public function render()
    {
        return view('livewire.admin.manage-sub-categories', [
            'subCategories' => SubCategory::query()
                                            ->with('category')
                                            ->latest()
                                            ->paginate(5),
            'categories' => Category::query()
                                    ->get(['id', 'name'])
        ]);
    }
}
