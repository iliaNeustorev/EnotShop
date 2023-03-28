<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Models\Product as ModelsProduct;
use App\Models\Category as ModelsCategory;

class Category extends Controller
{
    /*
        Получить все категории
    */
    public function all() : Collection
    {
        $categories = ModelsCategory::orderBy('name')
            ->get()
            ->transform(function (ModelsCategory $category) {
                $category->picture = $category->image->url;
                return $category;
            });

        return $categories;
    }

    /*
        Получить список категорий для NavBar
    */
    public function allForNavBar() : Collection
    {
        return ModelsCategory::orderBy('name')->withCount('products')->pluck('name','slug');
    }

     /*
        Получить категорию и связаные с ней продукты
    */
    public function oneWithProducts(string $slug) : array
    {
        $category = ModelsCategory::orderBy('name')->where('slug', $slug)->firstOrfail();
        $products = $category
                    ->products()
                    ->sumDiscount()
                    ->get()
                    ->transform(function(ModelsProduct $product){
                        $product->image = $product->images()->first()->url;
                        return $product;
                    });
        return [
            'products' => $products, 
            'categoryName' => $category->name, 
            'count' => $category->products()->count()
        ];
    }
}
