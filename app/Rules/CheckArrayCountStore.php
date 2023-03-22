<?php

namespace App\Rules;

class CheckArrayCountStore extends CheckCountStore 
{

    public function __construct(
        protected string $model
        ) {}

    public function passes($attribute, $array) : bool
    {
        foreach ($array as $id => $quantity) {
            if($quantity < 0) {
                return false;
            }
            if( $this->model::findOrfail($id)->count_store < $quantity ) {
                return false;
            }
        }
        return true;
    }
}
