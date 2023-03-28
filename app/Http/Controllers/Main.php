<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class Main extends Controller
{
    /*
       Сформировать главный view spa
    */
    public function showSpa(Request $request) : View
    {
        $user = $request->user();
        $img = $user?->image?->name;
        $user = $user?->toArray();
        $filtredUser = collect($user)->put('img', $img)->only(['id', 'name', 'email_verified_at', 'blocked', 'img']);
        $routes = [ 
            'auth' => '/auth/login', 
            'logout' => '/auth/logout', 
            'register' => '/auth/register',
            'verifyEMail' => '/email/verification-notification'
        ];
        $context = [ 'user' => $filtredUser, 'routes' => $routes ];
        return view('spa', compact('context'));
    }
}
