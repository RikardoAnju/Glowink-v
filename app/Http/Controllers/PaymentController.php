<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
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
                'order_id' => (string) Str::slug(Str::uuid()),
                'gross_amount' => (int) $request->grand_total,
            ],
            'item_details' => [
                [
                    'price' => (int) $request->grand_total,
                    'quantity' => 1,
                    'name' => $request->nama_barang,
                ],
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
            $payment->nama_barang = $request->nama_barang;
            $payment->nama_member = $request->nama_member;
            $payment->total = $request->grand_total;
            $payment->provinsi = $request->provinsi;
            $payment->kabupaten = $request->kabupaten;
            $payment->detail_alamat = $request->detail_alamat;
            $payment->email = $request->email;
            $payment->status = 'pending';
            $payment->payment_token = $token;
            $payment->checkout_link = $checkout_link;
            $payment->save();

            return response()->json(['token' => $token, 'checkout_url' => $checkout_link]);
        } else {
            return response()->json(['error' => 'Token tidak ditemukan dalam respon', 'response' => $responseData], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = 'SB-Mid-server-neldKfU17v4PHZK9PhGufcNF';
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed != $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $payment = Payment::where('id_order', $request->order_id)->first();

        if ($payment) {
            $payment->status = $request->transaction_status;
            $payment->save();
        }

        return response()->json(['message' => 'Payment status updated'], 200);
    }

    public function success()
    {
        return view('home.success');
    }

    public function pending()
    {
        return view('home.pending');
    }

    public function error()
    {
        return view('home.error');
    }

    public function webhook(Request $request)
    {
        $midtransServerKey = env('MIDTRANS_SERVER_KEY');

        if (!$midtransServerKey) {
            return response()->json(['error' => 'MIDTRANS_SERVER_KEY is not set'], 500);
        }

        $auth = base64_encode("$midtransServerKey:");

        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get("https://api.sandbox.midtrans.com/v2/{$request->order_id}/status");

        if ($response->successful()) {
            $responseData = $response->json();
            $payment = Payment::where('id_order', $responseData['order_id'])->first();

            if ($payment) {
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
                        $payment->status = $responseData['transaction_status'];
                        $payment->save();
                }

                return response()->json(['message' => 'Payment status updated successfully'], 200);
            } else {
                return response()->json(['error' => 'Payment not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Failed to fetch payment status'], $response->status());
        }
    }

    public function show($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json(['data' => $payment], 200);
    }

    public function edit(Payment $payment)
    {
        return view('payment.edit', compact('payment'));
    }

    public function list()
    {
        return view('payment.index');
    }

    public function index()
    {
        $payments = Payment::all();

        return response()->json([
            'data' => $payments
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:menunggu,ditolak,diterima,settlement,pending,deny,expire,cancel',
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

}
