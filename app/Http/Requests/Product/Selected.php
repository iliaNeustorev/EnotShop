<?php

namespace App\Http\Requests\Product;

use App\Rules\CheckArray;
use App\Models\Product as ModelsProduct;
use Illuminate\Foundation\Http\FormRequest;

class Selected extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'items' => ['array', 'required', 'min:1', new CheckArray(ModelsProduct::class, true)]
        ];
    }
}
