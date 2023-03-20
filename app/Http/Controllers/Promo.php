<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\JsonResponse;
use App\Models\Promo as ModelsPromo;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Promo\Add as AddPromoRequest;
use App\Http\Requests\Promo\Check as CheckPromoRequest;

class Promo extends Controller
{
    /*
        Получить привязаный к пользователю промокод
    */
    public function get() : JsonResponse
    {
        $user = ModelsUser::findOrFail(auth()->user()->id);
        $promo = $user->promos()->where('used', false)->sole();
        return response()->json(['size' => $promo->size_discount, 'id' => $promo->id], 200);
    }

    /*
        Проверка промокода по имени
    */
    public function check(CheckPromoRequest $request) : ?JsonResponse
    {
        $text = $request->validated();
        try{
            $promo = ModelsPromo::all()->sole('name', $text['name']);
            return response()->json(['promo' => true, 'sizeDiscount' => $promo->size_discount, 'id' => $promo->id], 200);
        } catch(\Exception $e){
             throw ValidationException::withMessages([
                'name' => 'Неправильный промкод',
            ]);
        }
    }

    /*
        Прикрепить промокод к юзеру
    */
    public function addToUser(AddPromoRequest $request) : JsonResponse
    {
        $data = $request->validated();
        $user = ModelsUser::findOrFail(auth()->user()->id);
        if($user->promos->contains(fn (ModelsPromo $item) => $item->pivot->promo_id == $data['promoId']) || $user->promos()->where('used', false)->count() === 1)
            {
                return response()->json(['error'], 405);
            };
        $user->promos()->syncWithoutDetaching([$data['promoId']]);
        return response()->json(['Ok'], 200);
    }

    /*
        Открепить промокод от юзера
    */
    public function removeFromUser(AddPromoRequest $request) : JsonResponse
    {
        $data = $request->validated();
        ModelsUser::findOrFail(auth()->user()->id)->promos()->detach([$data['promoId']]);
        return response()->json(['Ok'], 200);
    }
}
