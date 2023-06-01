<?php

namespace App\Http\Livewire\Front\Subscriber;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Actions\UpdateUserStatus;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AccountStatus extends Component
{
    use LivewireAlert;

    public User $user;

    public bool $changeStatus = false;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function changeStatus()
    {
        $this->changeStatus = true;
    }

    public function confirm(UpdateUserStatus $updateUserStatus)
    {
        $updateUserStatus->handle($this->user);
        
        $message = match(intval($this->user->is_active)) {
            1 => __('activated'),
            0 => __('disabled'),
        };
        sleep(3);
        $this->reset(['changeStatus']);
        $this->alert('success', __('You have ') . $message . __(' your account.'), [
            'showCloseButton' => true,
            'width' => 500,
            'timer' => 5000,
        ]);
    }

    public function cancel()
    {
        $this->changeStatus = false;
    }

    public function render()
    {
        $locale = app()->getLocale();
        $disabled_at = Carbon::parse($this->user->disabled_at)->locale($locale . '_' . strtoupper($locale));

        return view('livewire.front.subscriber.account-status', [
            'admin' => User::query()->whereRelation('role', 'id', 1)->first(['phone_number', 'email']),
            'disabled_at' => $disabled_at->isoFormat('LLLL'),
        ])
        ->layout('front.subscribers.main-layout', ['subtitle' => trans('Account Status')]);
    }
}
