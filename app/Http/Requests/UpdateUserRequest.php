<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:30',
            'role' => 'required',
            'location' => 'required',
            'department_id' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required|max:10',
            'birth_date' => 'required|date'
        ];
    }

    public function messages()
    {
        return [

            'name.max' => 'Name must be more than 30 characters.',
            'mobile_no.max' => 'Mobile no. must be more than 10 numbers.',
        ];
    }
}
