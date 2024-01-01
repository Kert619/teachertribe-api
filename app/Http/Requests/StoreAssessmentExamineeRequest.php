<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentExamineeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'examinees' => ['required','array'],
            'examinees.*.first_name' => ['required'],
            'examinees.*.last_name' => ['required'],
            'examinees.*.contact' => ['required'],
            'examinees.*.email' => ['required', 'email'],
            'examinees.*.test_mode' => ['required'],
            'examinees.*.group_id' => ['required'],
            'examinees.*.schedule_from' => ['required'],
            'examinees.*.schedule_to' => ['required'],
            'assessment_id' => ['required']
        ];
    }
}
