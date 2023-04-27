<?php

namespace App\Http\Livewire\Front;

use App\Http\Requests\SubscriptionRequest;
use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\{Category, Pupil, Student, Subscription, Unemployed};
use App\Notifications\Front\Subscription\NewSubscriptionNotification;

class Subscriptions extends Component
{
    use WithFileUploads, LivewireAlert;

    // Common
    public $subscription_id;
    public $categories;
    public $language;

    public $location, $category;

    // User properties
    public $name, $email, $phone_number;
    
    // Company properties
    public $description, $website, $logo;

    // Talent properties
    public $aspiration, $birth_date;

    // Students
    public $universities;
    public $university, $training_school;

    // Pupils
    public $educations, $sections, $cycles, $languages;
    public $education_type, $section, $serie, $cycle, $current_class, $school;

    // Unemployed
    public $current_job, $diploma, $aptitudes, $qualifications;

    public function mount()
    {
        $this->subscription_id = request()->subscription->id;
        $this->categories = Category::query()->get(['id', 'name']);
        $this->languages = config('subscriptions.language');

        if ($this->subscription_id === 4) {
            $this->educations = config('subscriptions.education');
            $this->sections = config('subscriptions.section');
            $this->cycles = config('subscriptions.cycle');
        }

        if ($this->subscription_id === 3) {
            $this->universities = config('subscriptions.university');
        }
    }

    protected function rules(): array
    {
        return (new SubscriptionRequest())->rules($this->subscription_id);
    }

    public function save()
    {
        $this->validate($this->rules());
        $password = Str::random(10);
        $role = match($this->subscription_id) {
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5
        };

        if ($this->subscription_id === 2) {
            $userable = Company::query()->create([
                'category_id' => $this->category,
                'location' => $this->location,
                'description' => $this->description,
                'url' => $this->website,
            ]);

            if ($this->logo) {
                $name = uniqid() . '.' .$this->logo->extension();
                $this->logo->storeAs('public/companies/', $name);
                $userable->logo = $name;
                $userable->save();
            }
        } elseif (in_array($this->subscription_id, [3, 4, 5])) {
            if ($this->subscription_id === 3) { // Student
                $talentable = Student::query()->create([
                    'university' => config('subscriptions.university.' . $this->university),
                    'training_school' => config('subscriptions.training_school.' . $this->university)[$this->training_school],
                ]);
            } elseif ($this->subscription_id === 4) { // Pupil
                $talentable = Pupil::query()->create([
                    'section' => $this->section,
                    'cycle' => $this->cycle,
                    'serie' => $this->serie,
                    'class' => $this->current_class,
                    'school' => $this->school
                ]);
            } elseif ($this->subscription_id === 5) { // Unemployed
                $talentable = Unemployed::query()->create([
                    'diploma' => $this->diploma,
                    'current_job' => $this->current_job,
                    'aptitudes' => $this->aptitudes,
                    'qualifications' => $this->qualifications,
                ]);
            }

            $userable = $talentable->talent()->create([
                'category_id' => $this->category,
                'aspiration' => $this->aspiration,
                'language' => $this->language,
                'location' => $this->location,
                'birth_date' => $this->birth_date,
            ]);
        }

        $user = $userable->user()->create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'password' => $password,
            'role_id' => $role,
        ]);

        $subscription = Subscription::query()->find($this->subscription_id);
        $user->subscriptions()->attach($this->subscription_id, [
            'amount' => $subscription->amount,
            // 'starts_at' => now(),
            // 'ends_at' => now()->addWeeks($subscription->duration)
        ]);

        Notification::send([$user, User::query()->firstWhere('role_id', 1)], new NewSubscriptionNotification(['type' => $user->role->name, 'from' => $user->name]));

        alert('', trans('Your request for new subscription has been successfully sent. You will be contacted shortly for further details.'), 'success')->autoclose(10000);
        return redirect()->route('front.home');
    }
    
    public function render()
    {
        $series = [];
        if (! is_null($this->section)) {
            $series = array_merge(config('subscriptions.series.' . $this->section . '.gn'), config('subscriptions.series.' . $this->section . '.th'));
            if (! is_null($this->education_type)) {
                $series = config('subscriptions.series.' . $this->section . '.' . $this->education_type);
            }
        }
        
        $classes = [];
        if (! is_null($this->cycle)) {
            $classes = array_merge(config('subscriptions.class.en'), config('subscriptions.class.fr'));
            if (! is_null($this->section)) {
                $classes = config('subscriptions.class.' . $this->section);
            }
        }

        $training_schools = [];
        if (! is_null($this->university)) {
            $training_schools = config('subscriptions.training_school.' . $this->university);
        }
        return view('livewire.front.subscriptions', [
            'series' => $series,
            'classes' => $classes,
            'training_schools' => $training_schools,
        ]);
    }
}
