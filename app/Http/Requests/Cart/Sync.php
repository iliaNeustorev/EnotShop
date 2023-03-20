<?php

namespace App\Http\Requests\Cart;

use App\Rules\CheckArray;
use App\Rules\CheckArrayCountStore;
use App\Models\Product as ModelsProduct;
use Illuminate\Foundation\Http\FormRequest;

class Sync extends FormRequest
{
   
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'items' => [
                'array', 
                'required', 
                'min:1', 
                new CheckArray(ModelsProduct::class, true), 
                new CheckArrayCountStore(ModelsProduct::class)
            ],
        ];
    }
}
