<?php

namespace App\Http\Livewire\Front;

use App\Http\Requests\SubscriptionRequest;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\{Category, Company, Pupil, Student, Subscription, Unemployed, User};
use App\Notifications\Front\Subscription\NewSubscriptionNotification;
use Illuminate\Support\Arr;

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
    public $aspiration, $birth_date, $cv;

    // Students
    public $universities;
    public $university, $training_school;

    // Pupils
    public $educations, $sections, $cycles, $languages;
    public $education_type, $section, $serie, $cycle, $current_class, $school;

    // Unemployed
    public $current_job, $diploma, $aptitudes, $qualifications;

    // Free
    public $subscription_types, $type;

    public function mount()
    {
        $this->subscription_id = request()->subscription->id;
        $this->categories = Category::query()->get(['id', 'name']);
        $this->languages = config('subscriptions.language');

        if (in_array($this->subscription_id, [4, 1])) {
            $this->educations = config('subscriptions.education');
            $this->sections = config('subscriptions.section');
            $this->cycles = config('subscriptions.cycle');
        }

        if (in_array($this->subscription_id, [3, 1])) {
            $this->universities = config('subscriptions.university');
        }

        if ($this->subscription_id === 1) {
            $this->subscription_types = Subscription::query()->get(['id', 'name'])->except(1);
        }
    }

    protected function rules(): array
    {
        return (new SubscriptionRequest())->rules($this->subscription_id, $this->type);
    }

    public function save()
    {
        $this->validate($this->rules());
        
        $role = match($this->subscription_id) {
            1 => 6,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        };

        $app_name = strtolower(config('app.name'));
        $password = Str::random(10);

        if ($this->subscription_id === 2 || ($this->subscription_id === 1 && (int) $this->type === 2)) {
            $userable = Company::query()->create([
                'category_id' => $this->category,
                'location' => $this->location,
                'description' => $this->description,
                'url' => $this->website,
            ]);

            if ($this->logo) {
                $name = uniqid($app_name) . '.' . $this->logo->extension();
                $this->logo->storeAs('public/companies/', $name);
                $userable->logo = $name;
                $userable->save();
            }
        } elseif (in_array($this->subscription_id, [1, 3, 4, 5])) {
            if ($this->subscription_id === 3 || ($this->subscription_id === 1 && (int) $this->type === 3)) { // Student
                $talentable = Student::query()->create([
                    'university' => config('subscriptions.university.' . $this->university),
                    'training_school' => config('subscriptions.training_school.' . $this->university)[$this->training_school],
                ]);
            } elseif ($this->subscription_id === 4 || ($this->subscription_id === 1 && (int) $this->type === 4)) { // Pupil
                $talentable = Pupil::query()->create([
                    'section' => $this->section,
                    'cycle' => $this->cycle,
                    'serie' => $this->serie,
                    'class' => $this->current_class,
                    'school' => $this->school
                ]);
            } elseif ($this->subscription_id === 5 || ($this->subscription_id === 1 && (int) $this->type === 5)) { // Unemployed
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

            if ($this->cv) {
                $name = uniqid($app_name) . '.' . $this->cv->extension();
                $this->cv->storeAs('public/cv/', $name);
                $userable->cv = $name;
                $userable->save();
            }
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
        ]);
        
        $message = 'Your request for subscription has been successfully sent. You will be contacted shortly via WhatsApp by administrator for further details in order to validate your subscription.';
        
        Notification::send([$user, User::query()->firstWhere('role_id', 1)], new NewSubscriptionNotification(['type' => $subscription->name, 'from' => $user->name, 'slug' => $user->slug, 'password' => $password, 'message' => $message]));

        alert('', trans($message) . ' ' . trans('Your password has been sent to you by email.'), 'success')->autoclose(25000);

        $redirect = auth()->check() ? 'front.jobs.index' : 'login';
        return redirect()->route($redirect)->with('subscription', ['subscription_id' => $this->subscription_id, 'email' => $user->email]);
    }

    public function render()
    {
        $data = [];

        if ($this->subscription_id === 3) {
            $training_schools = [];
            if (! is_null($this->university)) {
                $training_schools = config('subscriptions.training_school.' . $this->university);
            }
            $data = [
                'training_schools' => $training_schools
            ];
        }

        if ($this->subscription_id === 4) {
            $series = [];
            if (! is_null($this->section)) {
                $series = Arr::collapse(config('subscriptions.series.' . $this->section));
                if (! is_null($this->education_type)) {
                    $series = config('subscriptions.series.' . $this->section . '.' . $this->education_type);
                }
            }

            $classes = [];
            if (! is_null($this->section)) {
                $classes = Arr::collapse(config('subscriptions.class.' . $this->section));
                if (! is_null($this->cycle)) {
                    $classes = config('subscriptions.class.' . $this->section . '.' . $this->cycle);
                }
            }

            $data = [
                'series' => $series,
                'classes' => $classes,
            ];
        }
        return view('livewire.front.subscriptions', $data);
    }
}
