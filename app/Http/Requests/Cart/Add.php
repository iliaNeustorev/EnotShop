<?php

namespace App\Http\Requests\Cart;

use App\Rules\CheckCountStore;
use App\Models\Product as ModelsProduct;
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
            'id' => ['required', 'integer', 'exists:products'],
            'quantity' => ['required', 'integer', 'min:1', new CheckCountStore(ModelsProduct::findOrfail($this->id))]
        ];
    }
}
