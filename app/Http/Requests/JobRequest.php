<?php

namespace App\Http\Requests;

use App\Models\Job;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->role_id === 2;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(int $step)
    {
        $generalRules = [
            'title' => 'required|string|max:150',
            'min_salary' => 'required|numeric|min:50000',
            'max_salary' => 'nullable|numeric|gt:min_salary',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'type' => 'required|' . Rule::in(array_keys(Job::TYPES)),
            'dateline' => 'required|date|after:'.now()->addWeek()->format('d-m-Y'),
            'description' => 'required|string|max:1000',
            'file' => 'nullable|file|mimes:doc,docx,pdf,ppt,xlsx|max:512',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|exists:tags,id',
        ];

        $requirementsRules = [
            'requirements.1' => 'required|string|max:200',
            'requirements.*' => 'required|string|distinct:ignore_case|max:200',
        ];

        $qualificationsRules = [
            'qualifications.1' => 'required|string|max:200',
            'qualifications.*' => 'required|string|distinct:ignore_case|max:200',
        ];

        return match ($step) {
            1 => $generalRules,
            2 => $requirementsRules,
            3 => $qualificationsRules,
            default => []
        };
    }
}
