<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesManage extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $name;

    public $deleteId;

    public $nameDelete = '';

    public $editCategory;

    public $deleteCategory;

    public $nameEdit;

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('closeModal');
    }

    public function showCreateForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->emit('openModal');
    }

    public function showEditForm(Category $category)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->emit('openEditModal');
        $this->editCategory = $category;
        $this->nameEdit = $category->name;
    }

    public function updateCategory()
    {
        $newData = $this->validate([
            'nameEdit' => ['string', 'unique:categories,name,'.$this->editCategory->id.'', 'required', 'min:3'],
        ]);
        Category::where('id', $this->editCategory->id)
            ->update([
                'name' => $newData['nameEdit'],
            ]);
        $this->alert('success', trans('The category has been updated'));
        $this->closeModal();
    }

    public function showDeleteForm(Category $category)
    {
        $this->resetErrorBag();
        $this->emit('openDeleteModal');
        $this->deleteId = $category->id;
        $this->nameDelete = $category->name;
    }

    public function addCategory()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $newData = $this->validate([
            'name' => ['string', 'unique:categories,name', 'required', 'min:3'],
        ]);
        Category::create($newData);
        $this->alert('success', trans('The new category has been created'));
        $this->closeModal();
    }

    public function destroyCategory()
    {
        // select sub-category
        $category = Category::query()->find($this->deleteId);
        $category->jobs()->delete();
        $category->subCategories()->delete();
        $category->delete();

        $this->alert('success', trans('The category has been deleted'));
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.categories-manage', ['categories' => Category::query()->OrderBy('id', 'desc')->paginate(5)]);
    }
}
