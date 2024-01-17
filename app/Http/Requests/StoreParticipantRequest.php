<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipantRequest extends FormRequest
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
            'fullname' => ['required', 'max:255'],
            'gender' => ['required', 'max:255'],
            'age' => ['required', 'integer'],
            'school' => ['required', 'max:255'],
            'course' => ['required', 'max:255'],
            'year_level' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'contact' => ['required', 'max:255'],
            'q1' => ['required'],
            'q2' => ['required'],
            'q3' => ['required'],
            'q4' => ['required'],
            'q5' => ['required'],
            'q6' => ['required'],
            'q7' => ['required'],
            'q8' => ['required', 'boolean'],
            'q9' => ['required'],
            'q10' => ['required'],
        ];
    }
}
