<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class addbarangController extends Controller
{
    public function add_barang()
    {
        return view('/add_barang');
    }
}
