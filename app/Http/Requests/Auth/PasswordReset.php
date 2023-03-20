<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class PasswordReset extends FormRequest
{
    
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
