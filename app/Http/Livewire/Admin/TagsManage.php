<?php

namespace App\Http\Livewire\Admin;

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

    public function closeModal()
    {
        $this->reset('name');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('closeModal');
    }

    public function showEditForm(Tag $tag)
    {
        // dd($tag);
        $this->reset('name');
        $this->resetErrorBag();
        $this->emit('openEditModal');
        $this->resetValidation();
        $this->selectedTag = $tag;
        $this->name = $this->selectedTag->name;
    }

    public function showCreateForm()
    {
        $this->reset('name');
        $this->resetErrorBag();
        $this->emit('openModal');
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
        $this->alert('success', trans('The tag has been updated'));
        $this->closeModal();
    }

    public function addTag()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $newData = $this->validate([
            'name' => ['string', 'unique:tags,name', 'required', 'min:2'],
        ]);
        Tag::create($newData);
        $this->alert('success', trans('The Tag has been created'));
        $this->closeModal();
    }

    public function deleteTag($id)
    {
        $this->deleteId = $id;
        $this->name = (Tag::find($this->deleteId))->name;
    }

    public function showDeleteForm(Tag $tag)
    {
        $this->emit('openDeleteModal');
        $this->deleteId = $tag->id;
        $this->name = $tag->name;
    }

    public function destroyTag()
    {
        $this->deleteTag = Tag::find($this->deleteId);
        $this->deleteTag->jobs()->detach();
        $this->deleteTag->delete();
        $this->alert('success', trans('The Tag has been deleted'));
        $this->closeModal();
    }

    public function resetAttributes()
    {
        $this->reset(['name', 'deleteId', 'selectedTag', 'deleteTag']);
    }

    public function render()
    {
        return view('livewire.admin.tags-manage', [
            'tags' => Tag::query()
                        ->withCount('jobs')
                        ->latest()
                        ->paginate(10)
        ]);
    }
}
