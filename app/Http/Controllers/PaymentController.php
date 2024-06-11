<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function create(Request $request)
    {
        // Menyiapkan parameter
        $params = [
            'transaction_details' => [
                'order_id' => (string) Str::uuid(),
                'gross_amount' => (int) $request->total,
            ],
            'customer_details' => [
                'first_name' => $request->nama_member,
                'email' => $request->email,
            ],
            'enabled_payments' => ['credit_card', 'bca_va', 'bni_va', 'bri_va'],
        ];

        $auth = base64_encode('SB-Mid-server-neldKfU17v4PHZK9PhGufcNF');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

        $responseData = $response->json();

        Log::info('Midtrans response: ', $responseData);

        if (isset($responseData['token'])) {
            $token = $responseData['token'];
            $checkout_link = $responseData['redirect_url'];

            Log::info('Midtrans checkout URL: ' . $checkout_link);

            $payment = new Payment;
            $payment->id_order = $params['transaction_details']['order_id'];
            $payment->status = 'pending';
            $payment->total = $request->total;
            $payment->nama_member = $request->nama_member;
            $payment->email = $request->email;
            $payment->provinsi = $request->provinsi;
            $payment->kabupaten = $request->kabupaten;
            $payment->detail_alamat = $request->detail_alamat;
            $payment->payment_token = $token;
            $payment->checkout_link = $checkout_link;
            $payment->save();

            return response()->json(['token' => $token, 'checkout_url' => $checkout_link]);
        } else {
            return response()->json(['error' => 'Token tidak ditemukan dalam respon', 'response' => $responseData], 500);
        }
    }
    public function webhook(Request $request)
    {
        // Mendapatkan MIDTRANS_SERVER_KEY dari environment variable
        $midtransServerKey = env('MIDTRANS_SERVER_KEY');
    
        // Memeriksa apakah MIDTRANS_SERVER_KEY telah diatur
        if (!$midtransServerKey) {
            return response()->json(['error' => 'MIDTRANS_SERVER_KEY is not set'], 500);
        }
    
        // Menghasilkan Authorization header untuk request ke API Midtrans
        $auth = base64_encode("$midtransServerKey:");
    
        // Melakukan request ke API Midtrans untuk mendapatkan status pembayaran
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get("https://api.sandbox.midtrans.com/v2/{$request->order_id}/status");
    
        // Memeriksa apakah respons berhasil diterima
        if ($response->successful()) {
            $responseData = $response->json();
    
            // Mencari pembayaran berdasarkan order_id
            $payment = Payment::where('id_order', $responseData['order_id'])->first();
    
            // Memeriksa apakah pembayaran ditemukan
            if ($payment) {
                // Memeriksa status transaksi dan melakukan tindakan yang sesuai
                switch ($responseData['transaction_status']) {
                    case 'settlement':
                        $payment->status = 'settlement';
                        $payment->save();
                        return redirect()->route('orders'); // Redirect ke halaman order setelah transaksi sukses
                    case 'capture':
                    case 'pending':
                    case 'deny':
                    case 'expire':
                    case 'cancel':
                        // Menangani status transaksi lain sesuai kebutuhan
                }
    
                return response()->json(['message' => 'Payment status updated successfully'], 200);
            } else {
                return response()->json(['error' => 'Payment not found'], 404);
            }
        } else {
            // Menangani kesalahan jika respons tidak berhasil diterima
            return response()->json(['error' => 'Failed to fetch payment status'], $response->status());
        }
    }
    

    // Menampilkan data pembayaran berdasarkan ID
    public function show($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json(['data' => $payment], 200);
    }

    // Menampilkan form edit pembayaran
    public function edit(Payment $payment)
    {
        return view('payment.edit', compact('payment'));
    }

    // Menampilkan daftar pembayaran
    public function list()
    {
        return view('payment.index');
    }

    // Menampilkan semua pembayaran dalam bentuk JSON
    public function index()
    {
        $payments = Payment::all();

        return response()->json([
            'data' => $payments
        ]);
    }

    

    // Memperbarui data pembayaran yang ada
    public function update(Request $request, Payment $payment)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:menunggu,ditolak,diterima',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $payment->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.',
            'data' => $payment
        ]);
    }

    // Menghapus data pembayaran
    public function destroy(Payment $payment)
    {
        if ($payment->bukti) {
            File::delete(public_path('images/'.$payment->bukti));
        }
        
        $payment->delete();

        return response()->json([
            'message' => 'Payment berhasil dihapus.'
        ]);
    }
}
