<?php

namespace App\Http\Livewire;

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

    public function resetInput()
    {
        $this->name = '';
        $this->nameDelete = '';
        $this->nameEdit = '';
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editCategory($id)
    {
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
        $this->alert('success', $newData['nameEdit'].' category has been updated');
        $this->resetInput();
        $this->closeModal();
    }

    public function addCategory()
    {
        $newData = $this->validate([
            'name' => ['string', 'unique:categories,name', 'required', 'min:3'],
        ]);
        Category::create($newData);
        $this->resetInput();
        $this->alert('success', trans($newData['name'].'category has been created'));
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
        $this->deleteCategory = Category::find($this->deleteId);
        $this->deleteCategory->delete();
        $this->alert('success', trans('The category has been deleted'));
        $this->resetInput();
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.categories-manage', ['categories' => Category::query()->OrderBy('id', 'desc')->paginate(5)]);
    }
}
