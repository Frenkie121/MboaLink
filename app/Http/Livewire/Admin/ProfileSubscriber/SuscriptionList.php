<?php

namespace App\Http\Livewire\Admin\ProfileSubscriber;

use App\Models\User;
use Livewire\{Component, WithPagination};
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SuscriptionList extends Component
{
    use LivewireAlert,WithPagination;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.admin.profile-subscriber.suscription-list', [
            'subscriptions' => $this->user->subscriptions()->paginate(5),
        ]);
    }
}
