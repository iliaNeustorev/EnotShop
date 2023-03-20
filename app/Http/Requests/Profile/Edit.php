<?php

namespace App\Http\Requests\Profile;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Edit extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => ['required', 'string','min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'number' => ['nullable', 'numeric', 'digits_between:5,50'],
        ];
    }
}
