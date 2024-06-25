<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Slider;
use App\Models\Product;

class SearchController extends Controller
{
    public function searchCustomer(Request $request)
    {
        $query = $request->input('query');

        // Validasi input pencarian
        $request->validate([
            'query' => 'required|min:1',
        ]);

        // Lakukan pencarian pada model Product
        $results = Product::where('nama_barang', 'LIKE', "%{$query}%")
                        ->orWhere('deskripsi', 'LIKE', "%{$query}%")
                        ->with('subcategory')
                        ->get();

        // Kirim hasil pencarian ke view customer
        return view('search.customer-result', compact('results', 'query'));
    }
}
