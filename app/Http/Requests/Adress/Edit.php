<?php

namespace App\Http\Requests\Adress;

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
            'text' => ['required', 'min:4', 'max:256']
        ];
    }
}
