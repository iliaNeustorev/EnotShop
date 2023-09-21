<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Adress as ModelsAdress;
use App\Http\Requests\Adress\Edit as AdressEditRequest;
use App\Http\Requests\Adress\Main as AdressMainRequest;
use App\Http\Requests\Adress\Store as AdressStoreRequest;

class Adress extends Controller
{
    /* 
        Получить адреса аутетифицированого пользователя и лимит адресов 
    */
    public function index() : array
    {
        $adresses = Auth::user()->adresses->sortByDesc('created_at')->values();
        return ['adresses' => $adresses, 'limit' => config('limit-user.adresses')];
    }

    /* 
        Добавить новый адрес пользователя 
    */
    public function store(AdressStoreRequest $request) : JsonResponse
    {
        $user = Auth::user();
        $data = $request->validated();
        $newAdresses = User::findOrfail($user->id)->adresses()->create(['text' => $data['text']]);
        if($data['main'] ?? false) {
            $this->updateMain($newAdresses->id, $user);
        }
        
        return response()->json(['OK'], 200);
    }

    /* 
        Реадактировать текст адреса пользователя 
    */
    public function update(AdressEditRequest $request, int $id) : JsonResponse
    {
        $data = $request->validated();
        ModelsAdress::findOrfail($id)->update($data);

        return response()->json(['OK'], 200);
    }

     /* 
        Удалить адрес пользователя 
     */
    public function destroy(int $id) : JsonResponse
    {
        $user = Auth::user();
        User::findOrfail($user->id)->adresses()->findOrfail($id)->delete();

        return response()->json(['OK'], 200);
    }

     /* 
        Изменить основной адрес пользователя 
     */
    public function changeMain(AdressMainRequest $request) : JsonResponse
    {
        $user = Auth::user();
        $data = $request->validated();
        $this->updateMain($data['main'], $user);

        return response()->json(['OK'], 200);
    }

     /* 
        Вспомогательный метод для обнуления основного адреса пользователя 
     */
    protected function updateMain(int $id, User $user) : void
    {
        $userAdresses = $user->adresses();
        $userAdresses->update(['main' => false]);
        $userAdresses->where('id', $id)->update(['main' => true]);
    }
}
