<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriberProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return in_array(auth()->user()->role_id, [2, 3, 4, 5]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $commonRules = [
            'name' => 'required|string|max:100|unique:users,name,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone_number' => 'required|string|size:9|starts_with:65,67,68,69,66,232',
            'location' => 'required|string|max:100',
        ];

        $talentRules = [
            'birth_date' => 'required|date|before:' . now()->subYears(18)->format('d-m-Y') . '|after:' . now()->subYears(50)->format('d-m-Y'),
            'aspiration' => 'required|string|max:500',
            'cv' => 'nullable|file|mimes:doc,docx,pdf|max:1024',
        ];

        $companyRules = [
            'description' => 'required|string|max:500',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:png,jpeg,jpg|max:512',
        ];

        if (auth()->user()->role_id === 2) {
            $rules = array_merge($commonRules, $companyRules);
        } else {
            $rules = array_merge($commonRules, $talentRules);
        }

        return $rules;
    }
}
