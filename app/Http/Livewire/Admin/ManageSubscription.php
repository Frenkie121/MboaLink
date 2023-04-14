<?php

namespace App\Http\Livewire\Admin;

use App\Models\Offer;
use App\Models\Subscription;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ManageSubscription extends Component
{
    use WithPagination, LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $deleteId, $name, $deleteSubscription;
    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('closeModal');
    }
    public function showDeleteForm(Subscription $subscription)
    {
        $this->emit('openModalDelete');
        $this->deleteId = $subscription->id;
        $this->name = $subscription->name;
    }
    // public function delete($id)
    // {
    //     $this->deleteId = $id;
    //     $this->name = (Subscription::find($this->deleteId))->name;
    // }
    public function destroy()
    {
        // Offer::where('subscription_id', $this->deleteId)->delete();
        $this->deleteSubscription = Subscription::find($this->deleteId);
        $this->deleteSubscription->offers()->delete();
        $this->deleteSubscription->delete();
        // toast(trans('The Subscription has been deleted'), 'success');
        $this->alert('success', trans('The Subscription has been deleted'), [
            'showCloseButton' => true,
        ]);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.manage-subscription', ['subscriptions' => Subscription::query()
            ->latest()
            ->paginate(5)]);
    }
}
