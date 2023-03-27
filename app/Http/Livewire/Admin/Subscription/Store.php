<?php

namespace App\Http\Livewire\Admin\Subscription;

use App\Models\Subscription;
use Livewire\Component;

class Store extends Component
{
    public $datas;
    public function mount()
    {
       $this->datas=Subscription::all();
    }
    public function render()
    {
        return view('livewire.admin.subscription.store');
    }
}
