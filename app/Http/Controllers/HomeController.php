<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\product;
use App\Models\slider;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $sliders = slider::all();
        $categories = Category::all();
        $testimonis = Testimoni::all();
        $products = product::skip(0)->take(6)->get();
        return view('home.index', compact('sliders', 'categories', 'testimonis', 'products'));
    }
    public function products ($id_subcategory)
    {
        $products = product::where('id_subkategori', $id_subcategory)->get();
        return view('home.products', compact('products'));
    }
    public function product ($id_product)
    {
        $product = product::find($id_product);
        $lastest_products = product::orderByDesc('created_at')->offset(0)->limit(10)->get();
        return view('home.product', compact('product', 'lastest_products'));
    }
    public function cart ()
    {
        return view('home.cart');
    }
    public function checkout ()
    {
        return view('home.checkout');
    }
    public function orders ()
    {
        return view('home.orders');
    }
    public function about ()
    {
        $about = About::first();
        $testimonis = Testimoni::all();
        return view('home.about', compact('about', 'testimonis'));
    }
    public function contact ()
    {
        $about = About::first();
        return view('home.contact', compact('about'));
    }
    public function faq ()
    {
        return view('home.faq');
    }
}

