<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'data' => $categories
        ]);
    }

    public function show (Category $category)
    {
        return response()->json([
            'data'=> $category
        ]);
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048', // Batas maksimum ukuran gambar adalah 2MB
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        }

        $category = Category::create($input);

        return response()->json([
            'message' => 'Kategori berhasil disimpan.',
            'data' => $category
        ]);
    }

    /**
     * Memperbarui kategori yang ditentukan.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,webp|max:2048', // Batas maksimum ukuran gambar adalah 2MB
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        }

        $category->update($input);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui.',
            'data' => $category
        ]);
    }

    /**
     * Menghapus kategori yang ditentukan.
     */
    public function destroy(Category $category)
    {
        File::delete('uploads/' . $category->gambar);

        $category->delete();

        return response()->json([
            'message' => 'succes'
        ]);
    }
}
