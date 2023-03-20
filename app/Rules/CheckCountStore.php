<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckCountStore implements Rule
{
    protected int $count;

    public function __construct(Product $product)
    {
        $this->count = $product->count_store;
    }

    public function passes($attribute, $value) : bool
    {
        return $value <= $this->count;
    }

    public function message()
    {
        return trans('validation.checkCountStore');
    }
}
