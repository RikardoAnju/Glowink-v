<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'data' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048', // Batas maksimum ukuran gambar adalah 2MB
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
            'sku' => 'required',
            'stok' => 'required',
        ]);
            
        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), 
                422
            );
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        } else {
            unset($input['gambar']);
        }

        $product = Product::create($input);

        return response()->json([
            'message' => 'Produk berhasil disimpan.',
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
            return response()->json([
                'data'=> $product
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
            'sku' => 'required',
            'stok' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048', // Batas maksimum ukuran gambar adalah 2MB
        ]);
            
        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), 
                422
            );
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        } else {
            unset($input['gambar']);
        }

        $product = Product::create($input);

        return response()->json([
            'message' => 'Produk berhasil disimpan.',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
            // Menghapus gambar dari penyimpanan
            Storage::delete($product->gambar);
        
            // Menghapus data produk dari database
            $product->delete();
        
            return response()->json([
                'message' => 'success'
            ]);
    }
    
}
