<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Edit as ProfileEditRequest;
use App\Http\Requests\Profile\ChangeAvatar as ChangeAvatarRequest;
use App\Http\Requests\Profile\ChangePassword as ChangePasswordRequest;
use Illuminate\Support\Facades\Storage;

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
        User::findOrfail(auth()->user()->id)->update($data);
        return response()->json(['OK'], 200);
    }

     /*
        Изменить пароль пользователя
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
    
    /*
        Изменить аватар пользователя
     */
    public function changeAvatar(ChangeAvatarRequest $request) : JsonResponse
    {
        $user = $request->user();
        $file = $request->picture;
        $currentPictureName = $user->image->name;
        if($currentPictureName != 'nopicture.png')
            {
                Storage::delete("public/img/profile/$currentPictureName");
            }
        $fileName = $request->setPictureName($file);
        $user->image()->update(['name' => $fileName]);
        Storage::putFileAs('public/img/profile/', $file, $fileName);

        return response()->json(['OK'], 200);
    }

    /*
        Удалить аватар пользователя
    */
    public function deleteAvatar() : JsonResponse
    {
        $user = request()->user();
        $currentPictureName = $user->image->name;
        if($currentPictureName != 'nopicture.png')
        {
            Storage::delete("public/img/profile/$currentPictureName");
        }
        $user->image()->update(['name' => 'nopicture.png']);

        return response()->json(['OK'], 200);
    }

    /*
        Удалить профиль пользователя
    */
    public function destroy(int $id) : JsonResponse
    {
        Auth::guard('web')->logout();
        User::findOrfail($id)->delete();
        session()->flash('notification', 'profile.delete');
        
        return response()->json(['OK'], 200);
    }
}
