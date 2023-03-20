<?php

namespace App\Http\Requests\Promo;

use Illuminate\Foundation\Http\FormRequest;

class Add extends FormRequest
{
   
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'promoId' => 'required|integer|exists:promos,id',
        ];
    }
}
