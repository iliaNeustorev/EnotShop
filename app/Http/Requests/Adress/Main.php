<?php

namespace App\Http\Requests\Adress;

use Illuminate\Foundation\Http\FormRequest;

class Main extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'main' => ['required', 'integer', 'exists:adresses,id'],
        ];
    }
}
