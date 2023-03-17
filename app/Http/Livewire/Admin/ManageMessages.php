<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use App\Notifications\admin\Contact\replyMessageNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ManageMessages extends Component
{
    public $name;
    public $reply;
    use WithPagination;
    use LivewireAlert;
    public $contact;
    public $showForm;
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
        $this->emit('openModal');
        $this->contact = $contact;
    }
    public function showReplyInput()
    {
        $this->emit('showFormReply');
        $this->showForm = true;
    }
    public function closeReply()
    {
        $this->emit('closeFormReply');
    }
    public function replyMessage(Contact $contact)
    {

        $response = $this->validate([
            "reply" => ['required', "string"]
        ]);
        dd("tapsser");
        $contact->response = $response['reply'];
        $contact->save();
        Notification::send($contact, new replyMessageNotification( $response['reply'], $contact->subject));
        $this->alert('success', trans('The response was successfully sent to ') . $contact->name);
    }
    public function render()
    {
        return view('livewire.admin.manage-messages', ['contacts' => Contact::query()->latest()->paginate(5)]);
    }
}
