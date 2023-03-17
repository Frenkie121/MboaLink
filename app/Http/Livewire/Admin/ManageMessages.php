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
    public $name;

    public $email;

    public $message;

    public $subject;

    public $reply;

    use WithPagination;
    use LivewireAlert;

    public $displayContact;

    public $showForm = false;

    protected $paginationTheme = 'bootstrap';

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('closeModal');
    }

    public function showModalForm(Contact $contact)
    {
        $this->resetValidation();
        $this->emit('openModal');
        $this->displayContact = $contact;
        $this->name = $contact->name;
        $this->email = $contact->email;
        $this->message = $contact->message;
        $this->subject = $contact->subject;
    }

    public function showReplyInput()
    {
        $this->emit('showFormReply');
        $this->showForm = true;
    }

    public function closeReply()
    {
        $this->emit('closeFormReply');
        $this->showForm = false;
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
       toast('success', trans('The response was successfully sent to ').$contact->name);
        $this->closeModal();

        return redirect()->route('admin.messages.index');
    }

    public function render()
    {
        return view('livewire.admin.manage-messages', ['contacts' => Contact::query()->latest()->paginate(5)]);
    }
}
