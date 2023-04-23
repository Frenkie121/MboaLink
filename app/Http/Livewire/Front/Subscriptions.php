<?php

namespace App\Http\Livewire\Front;

use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\{Category, User};
use Jantinnerezo\LivewireAlert\LivewireAlert;

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

    // Pupils
    public $educations, $sections, $cycles, $languages;
    public $education_type, $section, $serie, $cycle, $current_class;

    // Students
    public $universities;
    public $university, $training_school;

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
        $commonRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone_number' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
        ];

        $companyRules = [
            'description' => 'required|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:png,jpeg,jpg|max:512',
        ];
        return match($this->subscription_id) {
            1 => '',
            2 => array_merge($commonRules, $companyRules)
        };
    }

    public function save()
    {
        $this->validate($this->rules());
        
        $company = Company::query()->create([
            'category_id' => $this->category,
            'location' => $this->location,
            'description' => $this->description,
            'url' => $this->website,
        ]);

        $password = Str::random(10);
        $role = match($this->subscription_id) {
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5
        };
        $user = $company->user()->create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'password' => $password,
            'role_id' => $role,
        ]);

        if ($this->logo) {
            $name = Str::slug($user->name).'.'.$this->logo->extension();
            $this->logo->storeAs('public/companies/', $name);
            $company->logo = $name;
            $company->save();
        }

        alert('', trans('Your subscription has been successfully registered. You will be contacted shortly for further details.'), 'success')->autoclose(7000);
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
