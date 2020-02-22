<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'password'     => 'required',
                'new_password' => 'required|min:8'
            ];
        } else {
            return [
                'name'     => 'required|string|max:50',
                'username' => 'required|alpha_num|max:20|unique:users,username,' . auth()->id(),
                'email'    => 'required|email|max:255|unique:users,email,' . auth()->id(),
            ];
        }
    }
}
