<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            abort(404, 'Order not found');
        }

        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
    
    public function showOrders()
    {
        $orders = Order::with('member')->paginate(5); // Mengambil data dengan paginasi
        return view('pesanan.index', compact('orders'));
    }
    
    public function list()
    {
        $orders = Order::all();
        return view('pesanan.index', compact('orders'));
    }
    

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $keyword = $request->input('keyword');

    $orders = Order::with('member')
        ->when($keyword, function ($query, $keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->where('nama_barang', 'like', "%{$keyword}%")
                      ->orWhere('invoice', 'like', "%{$keyword}%")
                      ->orWhere('status', 'like', "%{$keyword}%")
                      ->orWhereDate('created_at', $keyword);
            });
        })
        ->paginate(10); // Menggunakan paginate untuk pagination

    return view('pesanan.index', compact('orders', 'keyword'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_member' => 'required',
            
        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        
        $order = Order::create($input);

        for ($i = 0; $i < count($input['id_produk']); $i++){
            OrderDetail::create([
                'id_order' => $order['id'],
                'id_produk' => $input['id_produk'][$i],
                'jumlah' => $input['jumlah'][$i],
                'total' => $input['total'][$i],

            ]);
        }
        
        return response()->json([
            'data' =>$order
        ]);
    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        $order->update($input);

        OrderDetail::where('id_order', $order['id'])->delete();

        for ($i = 0; $i < count($input['id_produk']); $i++){
            OrderDetail::create([
                'id_order' => $order['id'],
                'id_produk' => $input['id_produk'][$i],
                'jumlah' => $input['jumlah'][$i],
                'total' => $input['total'][$i],

            ]);
        }

        return response()->json([
            'message' => 'Succes',
            'data' => $order
        ]);
    }

    public function ubah_status(Request $request, Order $order)
    {
    
        $order->update([
            'status' =>$request->status
        ]);
         return response()->json([
            'message' => 'Succes',
            'data' => $order
        ]);
    }

    public function baru()
    {
        $orders = Order::with('member')->where('status', 'Baru')->get();
    
        return response()->json([
            'data' => $orders
        ]);
    }
    

    public function dikonfirmasi()
    {
        $orders = Order::with('member')-> where('status', 'Diskonfirmasi')->get();

        return response()->json([
            'data' =>$orders
        ]);
    }
    public function dikemas()
    {
        $orders = Order::with('member')->where('status', 'Dikemas')->get();

        return response()->json([
            'data' =>$orders
        ]);
    }
    public function dikirim()
    {
        $orders = Order::with('member')-> where('status', 'Dikirim')->get();

        return response()->json([
            'data' =>$orders
        ]);
    }
    public function diterima()
    {
        $orders = Order::with('member')-> where('status', 'Diterima')->get();

        return response()->json([
            'data' =>$orders
        ]);
    }
    public function selesai()
    {
        $orders = Order::with('member')-> where('status', 'Selesai')->get();

        return response()->json([
            'data' =>$orders
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message'=>'succes'
        ]);
    }
}
