<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProblemRequest extends FormRequest
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
            'problem_title' => ['required', 'max:255', 'unique:problems'],
            'problem_description' => ['nullable'],
            'problem_type_id' => ['required'],
            'difficulty' => ['required'],
            'duration' => ['required'],
            'instructions' => ['nullable']
        ];
    }
}
