<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('tentang.index', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul_website' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->except('logo');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $nama_logo = time() . '.' . $logo->getClientOriginalExtension();
            
            // Simpan gambar baru
            $logo->storeAs('uploads', $nama_logo, 'public');
            
            // Hapus gambar lama jika ada
            if ($about->logo) {
                Storage::disk('public')->delete('uploads/' . $about->logo);
            }
            
            // Simpan nama gambar baru ke dalam input
            $input['logo'] = $nama_logo;
        }

        // Update data About
        $about->update($input);
        
        return redirect('/tentang')->with('success', 'Data Tentang berhasil diperbarui');
    }
}