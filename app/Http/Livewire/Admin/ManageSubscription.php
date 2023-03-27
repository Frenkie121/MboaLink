<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subscription;
use Livewire\Component;

class ManageSubscription extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-subscription',['subscriptions'=>Subscription::query()
                                                                                                        ->latest()
                                                                                                        ->paginate(5)]);
    }
}
