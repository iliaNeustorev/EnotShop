<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Models\Product as ModelsProduct;
use App\Http\Requests\Product\Selected as ProductSelectedRequest;

class Product extends Controller
{
     /*
       Получить все продукты
    */
    public function all()
    {
        return ModelsProduct::all();
    }

    /*
       Получить один продукт
    */
    public function one(string $slug) : ModelsProduct
    {
       return ModelsProduct::where('slug', $slug)
            ->with('images:id,imageable_type,imageable_id,url')
            ->with('category:id,name,slug')
            ->sumDiscount()
            ->firstOrFail();
    }

    /*
        Получить первые 5 самых продаваемых продуктов
    */
    public function mostSold() : Collection
    {
        return ModelsProduct::orderByDesc('count_sold')
            ->sumDiscount()
            ->get()
            ->take(5)
            ->transform(function(ModelsProduct $product){
                $product->image = $product->images()->first()->url;
                return $product;
            });
    }

    /*
        Получить коллекцию выбраных по id продуктов
    */
    public function loadSelected(ProductSelectedRequest $request) : Collection
    {
        $validated = $request->validated();
        $products = ModelsProduct::sumDiscount()->get()->only(array_keys($validated['items']));
        return $products;
    }
}
