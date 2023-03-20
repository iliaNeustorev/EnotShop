<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Adress as ModelsAdress;
use Illuminate\Support\Collection;

class Adress extends Controller
{
    public function index() : Collection
    {
        return Auth::user()->adresses;
    }
}
