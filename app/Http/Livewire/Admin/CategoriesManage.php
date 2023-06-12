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

    // Added when writing test document
    public $selectedCategory;

    public function closeModal()
    {
        $this->resetAttributes();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('closeModal');
    }

    public function showCreateForm()
    {
        $this->resetAttributes();
        $this->resetErrorBag();
        $this->emit('openModal');
    }

    public function showEditForm(Category $category)
    {
        $this->resetAttributes();
        $this->resetErrorBag();
        $this->emit('openEditModal');
        $this->editCategory = $category;
        $this->nameEdit = $category->name;
    }

    public function updateCategory()
    {
        $newData = $this->validate([
            'nameEdit' => ['string', 'unique:categories,name,' . $this->editCategory->id . '', 'required', 'min:3'],
        ]);
        
        // Category::where('id', $this->editCategory->id)
        //     ->update([
        //         'name' => $newData['nameEdit'],
        //     ]);

        /*
        |- The method above doesn't touch mutators. For example the slug wasn't update there. -|
        */
        $this->editCategory->update(['name' => $newData['nameEdit']]);
        
        $this->alert('success', trans('The category has been updated'));
        $this->closeModal();
    }

    public function showDeleteForm(Category $category)
    {
        // $this->resetErrorBag();
        $this->emit('openDeleteModal');

        // ***
        $this->selectedCategory = $category;

        $this->deleteId = $category->id;
        $this->nameDelete = $category->name;
    }

    public function addCategory()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $newData = $this->validate([
            'name' => ['required', 'unique:categories,name', 'string', 'min:3'],
        ]);
        Category::create($newData);
        $this->alert('success', trans('The category has been created'));
        $this->closeModal();
    }

    public function destroyCategory()
    {
        // select sub-category
        $category = Category::query()->find($this->deleteId);
        // $category->jobs()->delete();
        if ($category->has('subCategories') && $category->doesntHave('jobs')) {
            $category->subCategories()->delete();
        }
        $category->delete();

        $this->alert('success', trans('The category has been deleted'));
        $this->closeModal();
    }

    public function updateStatus()
    {
        $status = $this->selectedCategory->disabled_at;
        $this->selectedCategory->update([
            'disabled_at' => $status ? NULL : now()
        ]);
        $this->closeModal();

        $message = $status ? trans('enabled') : trans('disabled ');
        $this->alert('success', trans('The category has been ') . $message);
    }

    public function resetAttributes()
    {
        $this->reset(['name', 'deleteId', 'nameDelete', 'editCategory', 'deleteCategory', 'nameEdit']);
    }

    public function render()
    {
        return view('livewire.admin.categories-manage', [
            'categories' => Category::query()
                                    ->withCount(['jobs'])
                                    ->orderBy('id', 'desc')
                                    ->paginate(10)
        ]);
    }
}
