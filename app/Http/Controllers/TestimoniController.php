<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonies = Testimoni::all();

        return response()->json([
            'data' => $testimonies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tesmoni' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048', // Max size 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        } else {
            return response()->json(['message' => 'File gambar tidak ada.'], 422);
        }

        $testimoni = Testimoni::create($input);

        return response()->json([
            'message' => 'Testimoni berhasil disimpan.',
            'data' => $testimoni
        ]);
    }
    public function show (Testimoni $testimoni)
    {
        return response()->json([
            'data'=> $testimoni
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $validator = Validator::make($request->all(), [
            'nama_tesmoni' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,webp|max:2048', // Max size 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        }

        $testimoni->update($input);

        return response()->json([
            'message' => 'Testimoni berhasil diperbarui.',
            'data' => $testimoni
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        if (File::exists(public_path($testimoni->gambar))) {
            File::delete(public_path($testimoni->gambar));
        }

        $testimoni->delete();

        return response()->json([
            'message' => 'Testimoni berhasil dihapus.'
        ]);
    }
}
