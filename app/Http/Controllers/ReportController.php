<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $report = DB::table('orders_details')
            ->join('products', 'products.id', '=', 'orders_details.id_produk')
            ->select(DB::raw('
                nama_barang,
                COUNT(*) as jumlah_dibeli,
                harga, 
                SUM(total) as pendapatan,
                SUM(jumlah) as total_qty'))
                ->whereRaw("DATE(orders_details.created_at) >= '{$request->dari}'")
                ->whereRaw("DATE(orders_details.created_at) <= '{$request->sampai}'")
                 ->groupBy('id_produk', 'nama_barang', 'harga')
                 ->get();

        return response()->json([
            'data' => $report
        ]);
    }
}
