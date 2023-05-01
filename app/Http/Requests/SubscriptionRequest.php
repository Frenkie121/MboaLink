<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(int $subscription_id, $type = null)
    {
        $commonRules = [
            'name' => 'required|string|max:255|unique:users,name',
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

        $talentRules = [
            'birth_date' => 'required|date|before:' . now()->subYears(18)->format('d-m-Y') . '|after:' . now()->subYears(50)->format('d-m-Y'),
            'aspiration' => 'required|string|max:255',
            'language' => 'required|string|' . Rule::in(array_keys(config('subscriptions.language'))),
            'cv' => 'nullable|file|mimes:doc,docx,pdf|max:1024',
        ];

        $studentRules = [
            'university' => 'required|string',
            'training_school' => 'required|string',
        ];

        $pupilRules = [
            'section' => 'required|string',
            'cycle' => 'required|string',
            'serie' => 'required|string',
            'current_class' => 'required|string',
            'school' => 'required|string',
        ];

        $unemployedRules = [
            'diploma' => 'required|string',
            'current_job' => 'required|string',
            'aptitudes' => 'required|string',
            'qualifications' => 'required|string',
        ];

        $rules = [];
        
        if ($subscription_id === 2 || ($subscription_id === 1 && (int) $type === 2)) {
            $rules = array_merge($commonRules, $companyRules);
        } elseif ($subscription_id === 3  || ($subscription_id === 1 && (int) $type === 3)) {
            $rules = array_merge($commonRules, $talentRules, $studentRules);
        } elseif ($subscription_id === 4 || ($subscription_id === 1 && (int) $type === 4)) {
            $rules = array_merge($commonRules, $talentRules, $pupilRules);
        } elseif ($subscription_id === 5 || ($subscription_id === 1 && (int) $type === 5)) {
            $rules = array_merge($commonRules, $talentRules, $unemployedRules);
        } else {
            $rules = $commonRules;
        }
        
        return $rules;
    }
}
