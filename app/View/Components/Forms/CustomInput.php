<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CustomInput extends Component
{

    public function __construct(
        public string $name,
        public string $label = '',
        public string $placeholder= '',
        public string $icon = '',
        public string $type = 'text'
        ) {}

   
    public function render() : View
    {
        return view('components.forms.custom-input');
    }
}
