<?php 

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{   
    public function edit(Testimoni $testimoni)
    {
        return view('testimoni.edit', compact('testimoni'));
    }

    public function list()
    {
        return view('testimoni.index');
    }

    public function index()
    {
        $testimonies = Testimoni::all();

        return response()->json([
            'success' => true,
            'data' => $testimonies
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_testimoni' => 'required',
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
            $input['gambar'] = url('uploads/' . $nama_gambar); // Menyimpan jalur lengkap gambar
        }

        $testimoni = Testimoni::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Testimoni berhasil disimpan.',
            'data' => $testimoni
        ]);
    }

    public function show($id)
    {
        $testimoni = Testimoni::find($id);
    
        if (!$testimoni) {
            return response()->json(['message' => 'Testimoni not found'], 404);
        }
    
        return response()->json(['data' => $testimoni], 200);
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $validator = Validator::make($request->all(), [
            'nama_testimoni' => 'required',
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
            $input['gambar'] = url('uploads/' . $nama_gambar); // Menyimpan jalur lengkap gambar
        }

        $testimoni->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Testimoni berhasil diperbarui.',
            'data' => $testimoni
        ]);
    }

    public function destroy(Testimoni $testimoni)
    {
        if (File::exists(public_path($testimoni->gambar))) {
            File::delete(public_path($testimoni->gambar));
        }

        $testimoni->delete();

        return response()->json([
            'success' => true,
            'message' => 'Testimoni berhasil dihapus.'
        ]);
    }
}
