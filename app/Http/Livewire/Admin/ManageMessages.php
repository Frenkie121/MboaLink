<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use App\Notifications\admin\Contact\replyMessageNotification;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMessages extends Component
{
    use WithPagination, LivewireAlert;

    public $reply;

    public $displayContact;

    protected $paginationTheme = 'bootstrap';

    public function closeModal()
    {
        $this->reset(['reply', 'displayContact']);
        $this->resetErrorBag();
        $this->emit('closeModal');
    }

    public function showModalForm(Contact $contact)
    {
        $this->resetValidation();
        $this->emit('openModal');
        $this->displayContact = $contact;
    }

    public function replyMessage(Contact $contact)
    {
        $this->emit('showFormReply');
        $response = $this->validate([
            'reply' => ['required', 'string'],
        ]);
        $contact->response = $response['reply'];
        $contact->save();

        Notification::send($contact, new replyMessageNotification($response['reply'], $contact->subject));

        $this->closeModal();

        toast(trans('The response was successfully sent to ') . $contact->name, 'success');

        return redirect()->route('admin.contacts.index');
    }

    public function render()
    {
        return view('livewire.admin.manage-messages', ['contacts' => Contact::query()->latest()->paginate(5)]);
    }
}
