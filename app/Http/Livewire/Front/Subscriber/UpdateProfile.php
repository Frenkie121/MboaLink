<?php

namespace App\Http\Livewire\Front\Subscriber;

use App\Http\Requests\SubscriberProfileUpdateRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use LivewireAlert, WithFileUploads;

    public $name, $email, $phone_number, $location, $birth_date, $cv, $aspiration;
    public $logo, $website, $description;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        if ($user->role_id !== 2) {
            $this->birth_date = $user->userable->birth_date;
            $this->location = $user->userable->location;
            $this->aspiration = $user->userable->aspiration;
        } else {
            $this->location = $user->userable->location;
            $this->description = $user->userable->description;
            $this->website = $user->userable->url;
        }
    }

    public function rules(): array
    {
        return (new SubscriberProfileUpdateRequest())->rules();
    }

    public function update()
    {
        $this->validate($this->rules());
        $app_name = strtolower(config('app.name')) . '-';

        $user = tap(request()->user())->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
        ]);
        
        if (auth()->user()->role_id !== 2) {
            $user->userable()->update([
                'birth_date' => $this->birth_date,
                'location' => $this->location,
                'aspiration' => $this->aspiration,
            ]);

            if ($this->cv) {
                $name = uniqid($app_name) . '.' . $this->cv->extension();
                $this->cv->storeAs('public/cv/', $name);
                $user->userable()->update(['cv' => $name]);
            }
        } else {
            $user->userable()->update([
                'location' => $this->location,
                'url' => $this->website,
                'description' => $this->description,
            ]);
            if ($this->logo) {
                $name = uniqid($app_name) . '.' . $this->logo->extension();
                $this->logo->storeAs('public/companies/', $name);
                $user->userable()->update(['logo' => $name]);
            }
        }

        sleep(3);
        toast(trans('Profile has been successfully updated.'), 'success');
        $this->redirect('/me');
    }

    public function render()
    {
        return view('livewire.front.subscriber.update-profile');
    }
}
