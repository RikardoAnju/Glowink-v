<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    public function show($id)
    {
        $subcategory = Subcategory::find($id);
    
        if (!$subcategory) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        return response()->json(['data' => $subcategory], 200);
    }
    public function edit(Subcategory $subcategory)
    {
        return view('subkategori.edit', compact('subcategory'));
    }
    public function list()
    {
        $categories = Category::all();
        return view('subkategori.index', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();

        return response()->json([
            'data' => $subcategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'nama_subkategori'=> 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        }

        // Create the subcategory
        $subcategory = Subcategory::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Subkategori berhasil disimpan.',
            'data' => $subcategory
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,webp'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $input = $request->only(['id_kategori', 'deskripsi']); // Hanya ambil input id_kategori dan deskripsi
    
        // Handle image upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
    
            // Hapus gambar lama jika ada
            if ($subcategory->gambar && File::exists(public_path($subcategory->gambar))) {
                File::delete(public_path($subcategory->gambar));
            }
        }
    
        try {
            $subcategory->update($input);
            return response()->json([
                'success' => true,
                'message' => 'Subkategori berhasil diperbarui.',
                'data' => $subcategory
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan dalam pembaruan
            return response()->json(['message' => 'Error in updating subcategory.'], 500);
        }
    }

    
    public function destroy(Subcategory $subcategory)
    {
        // Hapus gambar jika ada
        if ($subcategory->gambar && File::exists(public_path($subcategory->gambar))) {
            File::delete(public_path($subcategory->gambar));
        }
    
        // Hapus subkategori
        $subcategory->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Subkategori berhasil dihapus.'
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
  
}
