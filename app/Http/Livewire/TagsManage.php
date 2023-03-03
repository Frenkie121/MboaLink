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

    protected $paginationTheme = 'bootstrap';

    public function resetInput()
    {
        $this->name = '';
        // $this->nameDelete = '';
        // $this->nameEdit = '';
        $this->reset();
    }

    public function addTag()
    {
        $newData = $this->validate([
            'name' => ['string', 'unique:tags,name', 'required', 'min:3'],
        ]);
        Tag::create($newData);
        $this->resetInput();
        $this->alert('success', trans($newData['name'].'Tag has been created'));
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.tags-manage', ['tags' => Tag::query()->OrderBy('id', 'desc')->paginate(5)]);
    }
}
