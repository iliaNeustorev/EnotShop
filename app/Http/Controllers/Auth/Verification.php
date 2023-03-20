<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class Verification extends Controller
{

    public function repeatSendMail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->intended(RouteServiceProvider::HOME)->with('notification','auth.verify-mail');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        
        return redirect()->intended(RouteServiceProvider::HOME)->with('notification', 'auth.verify');
    }
    
}
