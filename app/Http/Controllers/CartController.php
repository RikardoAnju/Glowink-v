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
    /**
     * Menambahkan barang ke dalam keranjang belanja.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add_to_cart(Request $request)
    {
        // Validasi data yang diterima dari request
        $validator = Validator::make($request->all(), [
            'id_member' => 'required|integer',
            'id_barang' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'is_checkout' => 'required|boolean',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Validasi berhasil, lanjutkan dengan data yang divalidasi
        $validatedData = $validator->validated();

        try {
            // Cari produk berdasarkan ID barang
            $product = Product::findOrFail($validatedData['id_barang']);

            // Cek apakah produk sudah ada di keranjang untuk member ini
            $cartItem = Cart::where('id_member', $validatedData['id_member'])
                            ->where('id_barang', $validatedData['id_barang'])
                            ->first();

            if ($cartItem) {
                // Jika produk sudah ada di keranjang, update jumlahnya
                $newQuantity = $cartItem->jumlah + $validatedData['jumlah'];
                $cartItem->update(['jumlah' => $newQuantity]);

                // Respons sukses
                return response()->json(['message' => 'Kuantitas produk di keranjang berhasil diperbarui.']);
            } else {
                // Jika produk belum ada di keranjang, tambahkan sebagai item baru
                $total = $product->harga * $validatedData['jumlah'];
                Cart::create([
                    'id_member' => $validatedData['id_member'],
                    'id_barang' => $validatedData['id_barang'],
                    'nama_barang' => $product->nama_barang,
                    'jumlah' => $validatedData['jumlah'],
                    'total' => $total,
                    'is_checkout' => $validatedData['is_checkout']
                ]);

                // Respons sukses
                return response()->json(['message' => 'Barang berhasil ditambahkan ke dalam keranjang.']);
            }

        } catch (ModelNotFoundException $e) {
            // Tangani jika produk tidak ditemukan
            Log::error('Produk tidak ditemukan: ' . $e->getMessage());
            return response()->json(['error' => 'Produk tidak ditemukan.'], 404);

        } catch (\Exception $e) {
            // Tangani kesalahan umum dengan mencatat pesan log
            Log::error('Error menambahkan ke keranjang: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menambahkan ke keranjang.'], 500);
        }
    }
}
