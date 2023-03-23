<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
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
        $data = $request->validated();
        $newAdresses = $request->user()->adresses()->create(['text' => $data['text']]);
        if($data['main'] ?? false) {
            $this->updateMain($newAdresses->id, $request);
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
    public function destroy(int $id, Request $request) : JsonResponse
    {
        $request->user()->adresses()->findOrfail($id)->delete();

        return response()->json(['OK'], 200);
    }

     /* 
        Изменить основной адрес пользователя 
     */
    public function changeMain(AdressMainRequest $request) : JsonResponse
    {
        $data = $request->validated();
        $this->updateMain( $data['main'], $request);

        return response()->json(['OK'], 200);
    }

     /* 
        Вспомогательный метод для обнуления основного адреса пользователя 
     */
    protected function updateMain(int $id, Request $request) : void
    {
        $userAdresses = $request->user()->adresses();
        $userAdresses->update(['main' => false]);
        $userAdresses->where('id', $id)->update(['main' => true]);
    }
}
