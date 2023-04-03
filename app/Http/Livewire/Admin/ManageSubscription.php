<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subscription;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ManageSubscription extends Component
{
    use WithPagination, LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.manage-subscription', ['subscriptions' => Subscription::query()
            ->latest()
            ->paginate(5)]);
    }
}
