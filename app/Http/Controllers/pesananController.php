<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Pesanan; // Menggunakan model Pesanan dari namespace App\Models

class PesananController extends Controller
{
    // Metode untuk menampilkan halaman pesanan
    public function pesanan()
    {
        return view('pesanan');
    }

    // Metode untuk mengubah status pesanan
    public function ubahStatus(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);

        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    // Metode untuk mendapatkan pesanan yang telah dikonfirmasi
    public function getKomfirmasiPesanan(Request $request)
    {
        $user = auth()->user();
        Log::info('User ID:', ['id' => $user->id]);

        $pesanan = Pesanan::with('member')->where('status', 'Dikonfirmasi')->get();
        Log::info('Pesanan Data:', ['data' => $pesanan]);

        return response()->json(['data' => $pesanan], 200);
    }

    // Metode untuk mendapatkan pesanan yang dikemas
    public function getKemasPesanan(Request $request)
    {
        $user = auth()->user();
        Log::info('User ID:', ['id' => $user->id]);

        $pesanan = Pesanan::with('member')->where('status', 'Dikemas')->get();
        Log::info('Pesanan Data:', ['data' => $pesanan]);

        return response()->json(['data' => $pesanan], 200);
    }

    // Metode untuk mendapatkan pesanan yang dikirim
    public function getKirimPesanan(Request $request)
    {
        $user = auth()->user();
        Log::info('User ID:', ['id' => $user->id]);

        $pesanan = Pesanan::with('member')->where('status', 'Dikirim')->get();
        Log::info('Pesanan Data:', ['data' => $pesanan]);

        return response()->json(['data' => $pesanan], 200);
    }

    // Metode untuk mendapatkan pesanan yang diterima
    public function getTerimaPesanan(Request $request)
    {
        $user = auth()->user();
        Log::info('User ID:', ['id' => $user->id]);

        $pesanan = Pesanan::with('member')->where('status', 'Diterima')->get();
        Log::info('Pesanan Data:', ['data' => $pesanan]);

        return response()->json(['data' => $pesanan], 200);
    }

    // Metode untuk mendapatkan pesanan yang selesai
    public function getSelesaiPesanan(Request $request)
    {
        $user = auth()->user();
        Log::info('User ID:', ['id' => $user->id]);

        $pesanan = Pesanan::with('member')->where('status', 'Selesai')->get();
        Log::info('Pesanan Data:', ['data' => $pesanan]);

        return response()->json(['data' => $pesanan], 200);
    }
}
