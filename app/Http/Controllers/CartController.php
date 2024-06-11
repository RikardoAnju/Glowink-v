<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        try {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'id_member' => 'required|integer',
                'id_barang' => 'required|integer',
                'jumlah' => 'required|integer|min:1',
                'total' => 'required|numeric|min:0',
                'is_checkout' => 'required|boolean',
            ]);

            // Cek apakah item sudah ada dalam keranjang untuk member tertentu
            $existingCartItem = Cart::where('id_member', $validatedData['id_member'])
                ->where('id_barang', $validatedData['id_barang'])
                ->first();

            if ($existingCartItem) {
                // Jika item sudah ada, tambahkan jumlah kuantitasnya
                $existingCartItem->jumlah += $validatedData['jumlah'];
                $existingCartItem->total += $validatedData['total'];
                $existingCartItem->save();
            } else {
                // Jika item belum ada, tambahkan sebagai item baru dalam keranjang
                Cart::create($validatedData);
            }

            // Response success
            return response()->json(['message' => 'Data berhasil ditambahkan ke dalam keranjang.']);
        } catch (\Exception $e) {
            // Tangani kesalahan dengan mencatat pesan log
            Log::error('Error adding to cart: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
