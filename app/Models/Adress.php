<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
        'main'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMain($query)
    {
        return $query->firstWhere('main', true);
    }
}
