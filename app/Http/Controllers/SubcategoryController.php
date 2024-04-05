<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::all();

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
            'nama_subkategori' => 'required',
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
            'message' => 'Subkategori berhasil disimpan.',
            'data' => $subcategory
        ]);
    }
    public function show (Subcategory $subcategory)
    {
        return response()->json([
            'data'=> $subcategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'nama_subkategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,webp',
            'kategori_id' => 'required|exists:kategoris,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        // Handle image update
        if ($request->hasFile('gambar')) {
            // Delete old image
            if (File::exists(public_path($subcategory->gambar))) {
                File::delete(public_path($subcategory->gambar));
            }

            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        }

        // Update the subcategory
        $subcategory->update($input);

        return response()->json([
            'message' => 'Subkategori berhasil diperbarui.',
            'data' => $subcategory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        // Delete the image file
        if (File::exists(public_path($subcategory->gambar))) {
            File::delete(public_path($subcategory->gambar));
        }

        // Delete the subcategory
        $subcategory->delete();

        return response()->json([
            'message' => 'Subkategori berhasil dihapus.'
        ]);
    }
}
