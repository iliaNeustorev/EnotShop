<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckArray implements Rule
{
    protected string $model;
    protected bool $checkKeys;

    public function __construct(string $model, bool $checkKeys = false)
    {
        $this->model = $model;
        $this->checkKeys = $checkKeys;
    }

    public function passes($attribute, $array) : bool
    {
        if($this->checkKeys)
        {  
            $array = array_keys($array);
        }
        foreach ($array as $id){
            if(!preg_match('/^[1-9]+\d*$/', $id)){
                return false;
            }
        }
        $cnt = $this->model::whereIn('id', $array)->count();
        return $cnt === count($array);
    }

   
    public function message() : string
    {
        return trans('validation.checkArray');
    }
}
