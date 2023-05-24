<?php

namespace App\Http\Livewire\Front\Subscriber;

use Livewire\Component;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdatePassword extends Component
{
    use LivewireAlert;

    public $current_password, $password, $password_confirmation;

    public function update()
    {
        $validated = $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        request()->user()->update([
            'password' => $validated['password'],
        ]);

        sleep(3);
        $this->reset();
        $this->alert('success', trans('Password has been successfully updated.'), [
            'showCloseButton' => true,
            'width' => 500,
        ]);
    }

    public function render()
    {
        return view('livewire.front.subscriber.update-password')
                    ->layout('front.subscribers.main-layout', ['subtitle' => trans('Update Password')]);
    }
}
