<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Job;
use App\Models\SubCategory;
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
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editCategory($id)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->editCategory = Category::find($id);
        $this->nameEdit = $this->editCategory->name;
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

    /**
     * drop data in database
     */
    public function deleteCategory($id)
    {
        $this->deleteId = $id;
        $this->nameDelete = (Category::find($this->deleteId))->name;
    }

    public function destroyCategory()
    {
        // select sub-category
        $subcategories = SubCategory::where('category_id', $this->deleteId)->get();
        foreach ($subcategories as $item) {
            $jobs = Job::where('sub_category_id', $item->id)->get();
            foreach ($jobs as $job) {
                $job->delete();
            }
        }
        // delete sub-category
        foreach ($subcategories as $subcategory) {
            $subcategory->delete();
        }
        $this->deleteCategory = Category::find($this->deleteId);
        $this->deleteCategory->delete();
        $this->alert('success', trans('The category has been deleted'));
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.categories-manage', ['categories' => Category::query()->OrderBy('id', 'desc')->paginate(5)]);
    }
}
