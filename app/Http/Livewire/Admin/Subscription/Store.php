<?php

namespace App\Http\Livewire\Admin\Subscription;

use App\Models\Subscription;
use Illuminate\Support\Str;
use Livewire\Component;

class Store extends Component
{
    public $i = 1;

    public $key, $offers,$amount, $duration, $name_s;

    public array $offersInput = [];

    public function add($i): void
    {
        $this->i = ++$i;
        array_push($this->offersInput, $i);

        $this->resetErrorBag();
    }

    public function remove($i): void
    {
        unset($this->offersInput[$i]);
    }

    public function save()
    {
        $data = $this->validate([
            'offers.0' => ['required', 'string', 'distinct'],
            'offers.*' => ['required', 'string', 'distinct'],
            'name_s' => ['required', 'string', 'unique:subscriptions,name'],
            'amount' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'numeric', 'min:0', 'max:12'],

        ]);
        $subscription = Subscription::create([
            'name' => $data['name_s'],
            'slug' => Str::slug($data['name_s']),
            'amount' => $data['amount'],
            'duration' => $data['duration'],
        ]);

        foreach ($this->offers as  $value) {
            $subscription->offers()->create(['content' => $value]);
        }
        toast(trans('The Subscription has been created'), 'success');

        return redirect()->route('admin.subscription.index');
    }

    public function render()
    {
        return view('livewire.admin.subscription.store');
    }
}
