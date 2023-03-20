<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Notifications extends Component
{
    public string|null $message;
    public bool $hasMessage;
    public array $messages;
    
    public function __construct()
    {
        $this->message = session()->get('notification');
        $this->hasMessage = $this->message !== null;
        $this->messages = $this->hasMessage ? config('app-notifications') : [];
    }

    public function render() : View
    {
        return view('components.notifications');
    }
}
