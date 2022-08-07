<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules['name']     = 'required';
        $rules['email']    = 'required|email|unique:users,email,' . $this->user;
        //$rules['role_id']  = '';
        if ($this->method() == "POST") {
            $rules['password'] = 'required|min:8|confirmed';
        } else {
            $rules['password'] = 'nullable|min:8|confirmed';
        }
        return $rules;
    }
}
