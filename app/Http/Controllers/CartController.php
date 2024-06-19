<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'id_member' => 'required|integer',
            'id_barang' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'is_checkout' => 'required|boolean',
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Validasi berhasil, lanjutkan dengan data yang divalidasi
        $validatedData = $validator->validated();

        try {
            // Cari barang berdasarkan ID
            $product = Product::findOrFail($validatedData['id_barang']);

            // Hitung total harga berdasarkan harga barang dan jumlahnya
            $total = $product->harga * $validatedData['jumlah'];

            // Jika is_checkout adalah true, hapus semua item dalam keranjang untuk member tersebut
            if ($validatedData['is_checkout']) {
                Cart::where('id_member', $validatedData['id_member'])->delete();
            }

            // Tambahkan item baru ke keranjang
            Cart::create([
                'id_member' => $validatedData['id_member'],
                'id_barang' => $validatedData['id_barang'],
                'nama_barang' => $product->nama_barang, // Tambahkan nama barang
                'jumlah' => $validatedData['jumlah'],
                'total' => $total, // Tambahkan total harga
                'is_checkout' => $validatedData['is_checkout']
            ]);

            // Response success
            return response()->json(['message' => 'Data berhasil ditambahkan ke dalam keranjang.']);
        } catch (ModelNotFoundException $e) {
            // Tangani kesalahan jika produk tidak ditemukan
            Log::error('Product not found: ' . $e->getMessage());
            return response()->json(['error' => 'Produk tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            // Tangani kesalahan dengan mencatat pesan log
            Log::error('Error adding to cart: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menambahkan ke keranjang.'], 500);
        }
    }
}
