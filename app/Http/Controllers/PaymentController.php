<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:menunggu, ditolak, diterima',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        $payment = Payment::create($input);

        return response()->json([
            'message' => 'Status berhasil disimpan.',
            'data' => $payment
        ]);
    }

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


    public function destroy(Payment $payment)
    {
        // Hapus gambar jika ada
        if ($payment->gambar) {
            File::delete(public_path($payment->gambar));
        }
        
        $payment->delete();

        return response()->json([
            'message' => 'Payment berhasil dihapus.'
        ]);
    }
}
