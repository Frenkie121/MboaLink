<?php

namespace App\Http\Livewire\Front;

use App\Models\Contact;
use Livewire\Component;

class SaveContact extends Component
{
    public string $name, $email, $subject, $message;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::query()
                ->create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'subject' => $this->subject,
                    'message' => $this->message,
                ]);

        // Mail

        alert('', trans('Your message has been successfully sent to the platform administrator. You will receive an email'), 'success');

        $this->redirectRoute('front.contact');
    }

    public function render()
    {
        return view('livewire.front.save-contact');
    }
}
