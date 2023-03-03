<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class TagsManage extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $name;

    public $deleteId;

    public $deleteTag;

    public $selectedTag;

    protected $paginationTheme = 'bootstrap';

    public function resetInput()
    {
        $this->name = '';
        $this->reset();
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editTag($id)
    {
        $this->selectedTag = Tag::find($id);
        $this->name = $this->selectedTag->name;
    }

    public function updateTag()
    {
        $newData = $this->validate([
            'name' => ['string', 'unique:tags,name,'.$this->selectedTag->id.'', 'required', 'min:2'],
        ]);
        Tag::where('id', $this->selectedTag->id)
            ->update([
                'name' => $newData['name'],
            ]);
        $this->alert('success', $newData['name'].' Tag has been updated');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function addTag()
    {
        $newData = $this->validate([
            'name' => ['string', 'unique:tags,name', 'required', 'min:2'],
        ]);
        Tag::create($newData);
        $this->alert('success', trans($newData['name'].'Tag has been created'));
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteTag($id)
    {
        $this->deleteId = $id;
        $this->name = (Tag::find($this->deleteId))->name;
    }

    public function destroyTag()
    {
        $this->deleteTag = Tag::find($this->deleteId);
        $this->deleteTag->delete();
        $this->alert('success', trans('The Tag has been deleted'));
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.tags-manage', ['tags' => Tag::query()->OrderBy('id', 'desc')->paginate(5)]);
    }
}
