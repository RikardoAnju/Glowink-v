<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function get_reports(Request $request)
    {
        $reports = DB::table('orders_details')
            ->join('products', 'products.id', '=', 'orders_details.id_produk')
            ->select(
                'products.nama_barang',
                DB::raw('COUNT(*) as jumlah_dibeli'),
                'products.harga',
                DB::raw('SUM(orders_details.total) as pendapatan'),
                DB::raw('SUM(orders_details.jumlah) as total_qty')
            )
            ->whereDate('orders_details.created_at', '>=', $request->dari)
            ->whereDate('orders_details.created_at', '<=', $request->sampai)
            ->groupBy('orders_details.id_produk', 'products.nama_barang', 'products.harga')
            ->get();

        return response()->json([
            'data' => $reports
        ]);
    }

    public function index(Request $request)
    {
        return view('report.index');
    }
}
