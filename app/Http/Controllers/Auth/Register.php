<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\Register as RegisterRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Register extends Controller
{
    public function create() : View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request) : RedirectResponse
    {

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $path = asset('storage/img/profile/nopicture.png');
        $user->image()->create(['url' => $path]);
        $user->cart()->create(['user_id' => $user->id]);
        // event(new Registered($user));
        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME)->with('notification', 'auth.register');
    }
}
