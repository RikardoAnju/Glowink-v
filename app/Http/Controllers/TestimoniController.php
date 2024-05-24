<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    /**
     * Menampilkan daftar resource.
     */
    public function index()
    {
        $testimoni = Testimoni::all();

        return response()->json([
            'success' => true,
            'data' => $testimoni
        ]);
    }

    public function show($id)
    {
        $testimoni = Testimoni::find($id);
    
        if (!$testimoni) {
            return response()->json(['message' => 'testimoni not found'], 404);
        }
    
        return response()->json(['data' => $testimoni], 200);
    }

    public function edit(Testimoni $testimoni)
    {
        return view('testimoni.index', compact('testimoni'));
    }

    public function list()
    {
        return view('testimoni.index');
    }

    /**
     * Menyimpan resource yang baru dibuat.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_testimoni' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048', // Batas maksimum ukuran gambar adalah 2MB
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

        $testimoni = Testimoni::create($input);

        return response()->json([
            'success' => true,
            'message' => 'testimoni successfully created.',
            'data' => $testimoni
        ]);
    }

    /**
     * Memperbarui resource yang ditentukan.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_testimoni' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,webp|max:2048', // Batas maksimum ukuran gambar adalah 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if (File::exists(public_path($testimoni->gambar))) {
                File::delete(public_path($testimoni->gambar));
            }

            // Upload gambar baru
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_gambar);
            $input['gambar'] = 'uploads/' . $nama_gambar;
        } else {
            unset($input['gambar']);
        }

        // Update resource
        $testimoni->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Testimoni successfully updated.',
            'data' => $testimoni
        ]);
    }

    /**
     * Menghapus resource yang ditentukan.
     */
    public function destroy(Testimoni $testimoni)
    {
        // Hapus gambar dari penyimpanan
        if (File::exists(public_path($testimoni->gambar))) {
            File::delete(public_path($testimoni->gambar));
        }

        // Hapus data dari database
        $testimoni->delete();

        return response()->json([
            'success' => true,
            'message' => 'Testimoni successfully deleted.'
        ]);
    }
}
