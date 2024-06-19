<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function get_reports(Request $request)
    {
        $report = DB::table('orders_details')
            ->join('products', 'products.id', '=', 'orders_details.id_produk')
            ->select(DB::raw('
                products.nama_barang,
                COUNT(*) as jumlah_dibeli,
                products.harga,
                SUM(orders_details.jumlah) as total_qty'))
            ->addSelect(DB::raw('SUM(orders_details.total) as total_harga'))
            ->whereRaw("DATE(orders_details.created_at) >= '{$request->input('dari')}'")
            ->whereRaw("DATE(orders_details.created_at) <= '{$request->input('sampai')}'")
            ->groupBy('orders_details.id_produk', 'products.nama_barang', 'products.harga', 'products.id')
            ->get();

        // Hitung pendapatan
        foreach ($report as $data) {
            $data->pendapatan = $data->total_harga * $data->jumlah_dibeli; // Perhitungan pendapatan (total_harga * jumlah_dibeli)
        }

        return response()->json([
            'data' => $report
        ]);
    }

    public function index(Request $request)
    {
       return view('report.index');
    }
}
