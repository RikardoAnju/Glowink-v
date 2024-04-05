<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class navbarController extends Controller
{
    public function kategori(){
        return view('/navbar');
}
}
