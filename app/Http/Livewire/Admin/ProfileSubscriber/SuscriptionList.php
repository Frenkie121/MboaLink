<?php

namespace App\Http\Livewire\Admin\ProfileSubscriber;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SuscriptionList extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $user;
    public function render()
    {

        return view('livewire.admin.profile-subscriber.suscription-list');
    }
}
