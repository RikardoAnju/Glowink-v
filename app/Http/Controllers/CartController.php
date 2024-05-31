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

            // Simpan data ke dalam database
            $cart = Cart::create($validatedData);

            // Response success
            return response()->json(['message' => 'Data berhasil ditambahkan ke dalam keranjang.']);
        } catch (\Exception $e) {
            // Tangani kesalahan dengan mencatat pesan log
            Log::error('Error adding to cart: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
