<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
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
        $this->reset();
    }

    public function editCategory($id)
    {
        $this->editCategory = Category::find($id);
        $this->nameEdit = $this->editCategory->name;
    }

    public function updateCategory()
    {
        $newData = $this->validate([
            'nameEdit' => ['string', 'unique:categories,name,' . $this->editCategory->id . '', 'required', 'min:3'],
        ]);
        Category::where('id', $this->editCategory->id)
            ->update([
                'name' => $newData['nameEdit'],
            ]);
        $this->alert('success', trans($newData['nameEdit'].' category has been updated'));
        $this->dispatchBrowserEvent('close-modal');
    }

    public function addCategory()
    {
        $newData = $this->validate([
            'name' => ['string', 'unique:categories,name', 'required', 'min:3'],
        ]);
        // dd("passer");
        Category::create($newData);
        $this->resetInput();
        $this->alert('success', trans($newData['name'] . 'category has been created'));
        $this->dispatchBrowserEvent('close-modal');
    }

    /**
     * drop data in database
     */
    public function deleteCategory($id)
    {
        $this->deleteId = $id;
        $this->nameDelete=(Category::find($this->deleteId))->name;
    }

    public function destroyCategory()
    {
        $this->deleteCategory = Category::find($this->deleteId);
        $this->nameDelete=$this->deleteCategory->name;
        $this->deleteCategory->delete();
        $this->alert('success', trans('The category has been deleted'));
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.categories-manage', ['categories' => Category::query()->OrderBy('id', 'desc')->paginate(5)]);
    }
}
