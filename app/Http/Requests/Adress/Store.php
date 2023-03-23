<?php

namespace App\Http\Requests\Adress;

use Illuminate\Auth\Access\Response ;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
  
    public function authorize() : Response
    {
        return self::getCountEntry() ? Response::allow()
        : Response::deny('Достигнут лимит адресов');
    }

    public function rules() : array
    {
        return [
            'text' => ['required', 'min:4', 'max:256'],
            'main' => ['boolean']
        ];
    }

    public function getCountEntry() : bool
    {
        return request()->user()->adresses()->count() < config('limit-user.adresses');
    }
}
