<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Category, SubCategory};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\{Component, WithPagination};

class ManageSubCategories extends Component
{
    use WithPagination, LivewireAlert;

    public $selectedSubCategory;
    public $name;
    public $category;

    protected $rules = [
        'name' => 'required|min:3|unique:sub_categories,name',
        'category' => 'required|exists:categories,id',
    ];

    public function showCreateForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->emit('openModal');
    }

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->emit('closeModal');
    }

    public function store()
    {
        $this->validate();
        SubCategory::query()
                    ->create([
                        'name' => $this->name,
                        'category_id' => $this->category,
                    ]);

        $this->closeModal();

        $this->alert('success', trans('The sub-category has been created'), [
            'showCloseButton' => true,
        ]);
    }

    public function showEditForm(SubCategory $subCategory)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->selectedSubCategory = $subCategory;

        $this->name = $subCategory->name;
        $this->category = $subCategory->category->id;

        $this->emit('openModal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3|unique:sub_categories,name,'.$this->selectedSubCategory->id,
            'category' => 'required|exists:categories,id',
        ]);

        $this->selectedSubCategory->update([
            'name' => $this->name,
            'category_id' => $this->category,
        ]);

        $this->closeModal();

        $this->alert('success', trans('The sub-category has been updated'), [
            'showCloseButton' => true,
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
            'showCloseButton' => true,
        ]);
    }

    public function updateStatus()
    {
        $status = $this->selectedSubCategory->disabled_at;
        $this->selectedSubCategory->update([
            'disabled_at' => $status ? NULL : now()
        ]);
        $this->closeModal();

        $message = $status ? trans('enabled') : trans('disabled ');
        $this->alert('success', trans('The sub-category has been ') . $message);
    }

    public function render()
    {
        return view('livewire.admin.manage-sub-categories', [
            'subCategories' => SubCategory::query()
                                            ->with('category:name,id')
                                            ->withCount('jobs')
                                            ->latest('created_at')
                                            ->paginate(10),
            'categories' => Category::query()
                                    ->oldest('name')
                                    ->enabled()
                                    ->get(['id', 'name']),
        ]);
    }
}
