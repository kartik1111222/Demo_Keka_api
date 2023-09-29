<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Http\Request;


class UserFormRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,id,',
            'password' => 'required',
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



    // public function rules(Request $request)
    // {
    //     $user = User::find($this->users);

    //     switch ($this->method()) {
    //         case 'GET':
    //         case 'DELETE': {
    //                 return [];
    //             }
    //         case 'POST': {
    //                 return [
    //                     'name' => 'required|max:30',
    //                     'role' => 'required',
    //                     'location' => 'required',
    //                     'department_id' => 'required',
    //                     'email' => 'required|email:users',
    //                     'password' => 'required',
    //                     'mobile_no' => 'required|max:10',
    //                     'birth_date' => 'required|date'
    //                 ];
    //             }
    //         case 'PUT':
    //         case 'PATCH': {
    //                 return [
    //                     'name' => 'required|max:30',
    //                     'role' => 'required',
    //                     'location' => 'required',
    //                     'department_id' => 'required',
    //                     'email' => 'required|email|unique:users,email,id,'.request()->id,
    //                     'password' => 'required',
    //                     'mobile_no' => 'required|max:10',
    //                     'birth_date' => 'required|date'
    //                 ];
    //             }
    //         default:
    //             break;
    //     }
    // }
}
