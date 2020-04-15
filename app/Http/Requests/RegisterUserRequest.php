<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:150',
            'doc_id' => 'required|integer|digits_between:7,8|unique:users,doc_id',
            'store_name' => 'required|max:150',
            'phone' => 'required|digits:11',
            'state_id' => 'required',
            'address' => 'required|max:190',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ];
    }
}
