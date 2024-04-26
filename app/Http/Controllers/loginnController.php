<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginnController extends Controller
{
    public function index(){
        return view('auth.loginn');
}
}
