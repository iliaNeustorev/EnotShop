<?php

use App\Models\Product;
use App\Models\Promo;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test', function () {
    // User::findOrFail(6)->promos()->attach([1]);
    // User::findOrFail(6)->promos()->updateExistingPivot(2, [
    //     'used' => true,
    // ]);
    // Promo::create(['name'=>'dry','size_discount'=>10]);
//    $product = Product::findOrfail(11);
// User::findOrFail(6)->discount()->create(['discount' => 15]);
User::findOrFail(6)->adresses()->create(['text' => 'Адрес three']);
})->purpose('OK');
