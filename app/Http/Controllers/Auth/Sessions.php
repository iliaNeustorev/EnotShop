<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\Login as LoginRequest;
use App\Models\User as ModelsUser;
use Illuminate\Support\Collection;

class Sessions extends Controller
{
    public function create() : View
    {
        return view('auth.login');
    }
    /**
     * залогинится
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }
      /**
     * разлогинится
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    
      /**
     * Получить юзера c ролями
     */
    public function getUser(Request $request) : Collection
    {
        $user = request()->user();
        $mainAdress = $user->adresses()->main()->text ?? null;
        $user = collect($user)->put('mainAdress', $mainAdress);
        // $user['admin'] = Gate::check('admin');
        // $user['likes'] = $request->user()->likes()->where('status', LikeStatus::LIKE)->pluck('likable_type','likable_id');
        // $user['dislikes'] = $request->user()->likes()->where('status', LikeStatus::DISLIKE)->pluck('likable_type','likable_id');
        return $user;
    }
}
    

