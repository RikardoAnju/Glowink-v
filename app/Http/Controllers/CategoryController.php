<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function show($id)
{
    $category = Category::find($id);

    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    return response()->json(['data' => $category], 200);
}

    public function edit(Category $category)
    {
        return view('kategori.edit', compact('category'));
    }

    public function list()
    {
        return view('kategori.index');
    }

    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
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

    public function update(Request $request, Category $category)
{
    $validator = Validator::make($request->all(), [
        'nama_kategori' => 'required',
        'deskripsi' => 'required',
        'gambar' => 'image|mimes:jpg,png,jpeg,webp|max:2048|nullable',
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

        // Hapus gambar lama jika ada
        if ($category->gambar) {
            File::delete(public_path($category->gambar));
        }
    }

    try {
        $category->update($input);
        return response()->json([
            'message' => 'Kategori berhasil diperbarui.',
            'data' => $category
        ]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error in updating category.'], 500);
    }
}


    public function destroy(Category $category)
    {
        // Hapus gambar jika ada
        if ($category->gambar) {
            File::delete(public_path($category->gambar));
        }
        
        $category->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}
