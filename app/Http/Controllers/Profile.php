<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\Edit as ProfileEditRequest;
use App\Models\User as ModelsUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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

    public function edit(ProfileEditRequest $request) : JsonResponse
    {
        $data = $request->validated();
        ModelsUser::findOrfail(auth()->user()->id)->update($data);
        return response()->json(['OK'], 200);
    }
}
