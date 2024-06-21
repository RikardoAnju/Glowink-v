<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    
    
 
    public function list()
    {
        $products = Product::with('category', 'subcategory')->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('product.index', compact('products', 'categories', 'subcategories'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'subcategory')->get();

        return response()->json([
            'success' => true,
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
            'ukuran' => 'required',
            'manfaat' => 'required',
            'harga' => 'required',
            'sku' => 'required',
            'bahan' => 'required',
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
            'success' => true,
            'message' => 'Produk berhasil disimpan.',
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    
     public function show($id)
     {
         $product = Product::find($id);
     
         if (!$product) {
             return response()->json(['message' => 'Product not found for ID ' . $id], 404);
         }
     
         return response()->json(['data' => $product], 200);
     }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
{
    return response()->json([
        'success' => true,
        'data' => $product
    ]);
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
            'manfaat' => 'required',
            'ukuran' => 'required',
            'sku' => 'required',
            'bahan' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,webp|max:2048', // Perhatikan tidak ada "required" di sini karena gambar tidak selalu harus diubah
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
            
            // Hapus gambar lama jika ada
            if ($product->gambar) {
                Storage::delete($product->gambar);
            }
        } else {
            unset($input['gambar']);
        }
    
        $product->update($input); // Menggunakan metode update untuk memperbarui data yang ada
    
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui.',
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
                'success' => true,
                'message' => 'success'
            ]);
    }
    
}
