<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Product as ModelsProduct;
use App\Http\Requests\Cart\Add as CartAddRequest;
use App\Http\Requests\Cart\Sync as CartSyncRequest;

class Cart extends Controller
{
    /*
       Получить корзину пользователя
    */
    public function all() : Collection
    {
       $cart = Auth::user()->cart->products->keyBy('id');
       $cart->transform(function(ModelsProduct $item){
            return $item->pivot->quantity;
            });
        return $cart;
    }

    /*
       Синхронизировать временную корзину с постоянной
    */
    public function sync(CartSyncRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        $cart = $validated['items'];
        foreach($cart as $key => $item){
            $cart[$key] = ['quantity' => $item];
        }
        Auth::user()->cart->products()->syncWithoutDetaching($cart);
        return response()->json(['success' => true], 200);
    }

    /*
       Добавить товар в корзину
    */
    public function add(CartAddRequest $request) : JsonResponse
    {
        $data = $request->validated();
        $cart = Auth::user()->cart;
        $cart->products()->syncWithoutDetaching([$data['id'] => [
            'quantity' => $data['quantity']
        ]]);
        return response()->json(['success' => true, 'cart'=> $this->all()], 200);
    }

    /*
       Удалить товар из корзины
    */
    public function remove(int $id) : JsonResponse
    {
        $cart = Auth::user()->cart;
        $cart->products()->detach([ ModelsProduct::findOrFail($id)->id ]);
        return response()->json(['success' => true, 'cart'=> $this->all()], 200);
    }
}
