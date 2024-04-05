<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Menampilkan daftar resource.
     */
    public function index()
    {
        $sliders = Slider::all();

        return response()->json([
            'data' => $sliders
        ]);
    }
    public function show (Slider $slider)
    {
        return response()->json([
            'data'=> $slider
        ]);
    }

    /**
     * Menyimpan resource yang baru dibuat.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_slider' => 'required',
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

        $slider = Slider::create($input);

        return response()->json([
            'message' => 'Slider berhasil disimpan.',
            'data' => $slider
        ]);
    }

    /**
     * Memperbarui resource yang ditentukan.
     */
    public function update(Request $request, Slider $slider)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_slider' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,webp|max:2048', // Batas maksimum ukuran gambar adalah 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                 422
                );
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if (File::exists(public_path($slider->gambar))) {
                File::delete(public_path($slider->gambar));
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
        $slider->update($input);

        return response()->json([
            'message' => 'Slider berhasil diperbarui.',
            'data' => $slider
        ]);
    }

    /**
     * Menghapus resource yang ditentukan.
     */
    public function destroy(Slider $slider)
    {
        // Hapus gambar dari penyimpanan
        if (File::exists(public_path($slider->gambar))) {
            File::delete(public_path($slider->gambar));
        }

        // Hapus data dari database
        $slider->delete();

        return response()->json([
            'message' => 'Slider berhasil dihapus.'
        ]);
    }
}
