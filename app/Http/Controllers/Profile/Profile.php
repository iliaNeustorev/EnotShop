<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Edit as ProfileEditRequest;
use App\Http\Requests\Profile\ChangePassword as ChangePasswordRequest;

class Profile extends Controller
{
    /*
        Получить персональную скидку пользователя
    */
    public function getDiscount() : JsonResponse
    {
        $discount = Auth::user()->discount;
        if($discount != null){
            return response()->json(['personalDiscount'=> $discount->discount], 200);
        }
        return response()->json(['personalDiscount'=> 0], 200);
    }

    /*
        Редактировать профиль пользователя
    */
    public function edit(ProfileEditRequest $request) : JsonResponse
    {
        $data = $request->validated();
        ModelsUser::findOrfail(auth()->user()->id)->update($data);
        return response()->json(['OK'], 200);
    }

     /**
     * Изменить пароль пользователя
     */
    public function changePassword(ChangePasswordRequest $request) : JsonResponse
    {
        $request->user()->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60)
        ])->save();
        Auth::logout();
        session()->flash('notification', 'password.change');
        
        return response()->json(['OK'], 200);
    }
}
