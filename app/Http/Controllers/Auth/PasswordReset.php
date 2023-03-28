<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PasswordReset extends Controller
{
    public function create() : View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('login')->with('notification', 'password.reset.email')
            : back()->withErrors(['email' => __($status)]);
    }
}
