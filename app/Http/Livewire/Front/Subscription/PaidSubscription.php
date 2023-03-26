<?php

namespace App\Http\Livewire\Front\Subscription;

use Livewire\Component;
use App\Models\{Category};

class PaidSubscription extends Component
{
    public int $currentStep = 1;
    public $subscription_id;
    public $categories;

    public function mount()
    {
        $this->subscription_id = request()->subscription->id;
        $this->categories = Category::query()->get(['id', 'name']);
    }

    public function previous($step)
    {
        $this->currentStep = $step;
    }

    public function validateInformations()
    {
        $this->currentStep = 2;
    }

    public function render()
    {
        return view('livewire.front.subscription.paid-subscription');
    }
}
