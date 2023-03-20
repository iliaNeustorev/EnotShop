<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category_id',
        'count_store'
    ];
    protected $hidden = [
        'count_sold',
        'created_at', 
        'updated_at',
        'deleted_at',
    ];

   

    public function images()
    {
       return $this->morphMany(Image::class, 'imageable');
    }

    public function discounts()
    {
        return $this->morphMany(Discount::class, 'discounteable');
    }

    public function carts() {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function scopeSumDiscount($query){
        return $query->withSum('discounts as total_discount', 'discount');
    }
}
