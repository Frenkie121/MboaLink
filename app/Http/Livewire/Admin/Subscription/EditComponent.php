<?php

namespace App\Http\Livewire\Admin\Subscription;

use App\Models\Offer;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Subscription;

class EditComponent extends Component
{
    public $subscription, $i = 1, $number;
    public   $offersInput = [];
    public $subs_name, $duration, $amount, $index;
    public array $offersInputAdd = [];
    public function mount(Subscription $subscription)
    {
        $this->subs_name = $subscription->name;
        $this->duration = $subscription->duration;
        $this->amount = $subscription->amount;
        $this->offersInput = Offer::where('subscription_id', $this->subscription->id)->get();
        $this->number = count($this->offersInput);
    }
    public function add($i): void
    {
        $this->i = ++$i;
        array_push($this->offersInputAdd, $i);

        $this->resetErrorBag();
    }

    public function remove($i): void
    {
        unset($this->offersInput[$i]);
        unset($this->offersInputAdd[$i]);
    }

    public function render()
    {
        return view('livewire.admin.subscription.edit-component')
            ->extends('admin.subscriptions.edit')
            ->section('content');
    }
}
