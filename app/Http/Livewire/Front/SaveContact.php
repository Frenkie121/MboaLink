<?php

namespace App\Http\Livewire\Front;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\Front\Contact\NewContactNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class SaveContact extends Component
{
    public string $name;

    public string $email;

    public string $subject;

    public string $message;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::query()
                ->create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'subject' => $this->subject,
                    'message' => $this->message,
                ]);

        // Mail
        Notification::send([$contact, User::query()->firstWhere('role_id', 1)], new NewContactNotification($contact));

        alert('', trans('Your message has been successfully sent to the platform administrator. You will receive an email as soon as possible.'), 'success')->autoclose(7000);

        $this->redirectRoute('front.contact');
    }

    public function render()
    {
        return view('livewire.front.save-contact');
    }
}
