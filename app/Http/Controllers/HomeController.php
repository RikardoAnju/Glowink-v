<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\cart;
use App\Models\Category;
use App\Models\Member;
use App\Models\Order;
use App\Models\Payment;
use App\Models\product;
use App\Models\slider;

use App\Models\Testimoni;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index ()
    {
        $sliders = slider::all();
        $categories = Category::all();
        $testimonis = Testimoni::all();
        $products = product::skip(0)->take(6)->get();
        return view('home.index', compact('sliders', 'categories', 'testimonis', 'products'));
    }
    public function products ($id_subcategory)
    {
        $products = product::where('id_subkategori', $id_subcategory)->get();
        return view('home.products', compact('products'));
    }
    public function product($id_product)
{
    // Cari produk dengan ID yang diberikan
    $product = Product::find($id_product);

    // Jika produk tidak ditemukan, kembalikan respons dengan pesan kesalahan
    if (!$product) {
        return response()->view('errors.404', [], 404);
    }

    // Jika produk ditemukan, ambil daftar 10 produk terbaru
    $latest_products = Product::orderByDesc('created_at')->take(10)->get();

    // Kembalikan tampilan produk dengan produk yang ditemukan dan daftar produk terbaru
    return view('home.product', compact('product', 'latest_products'));
}

public function cart()
{
    // Pastikan pengguna sudah login
    if (!Auth::guard('webmember')->check()) {
        return redirect('/login_member');
    }

    // Inisialisasi cURL untuk mengambil data provinsi dari API RajaOngkir
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 1dc1002793a890f90a69835a2c9858e4"
        ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return response()->json(['error' => 'cURL Error: ' . $err], 500);
    }

    $provinsi = json_decode($response, true)['rajaongkir']['results'];

    // Ambil id_member dari pengguna yang sedang login
    $id_member = Auth::guard('webmember')->user()->id;

    // Ambil item keranjang untuk pengguna yang sedang login dan belum checkout
    $carts = Cart::where('id_member', $id_member)->where('is_checkout', 0)->get();

    // Pastikan produk terkait ditemukan untuk setiap item di keranjang
    $carts->load('product'); // Pastikan relasi 'product' ada di model Cart

    // Filter keranjang untuk menghapus item yang tidak memiliki produk terkait
    $carts = $carts->filter(function($cart) {
        return $cart->product !== null;
    });

    // Hitung total harga item di keranjang
    $cart_total = $carts->sum('total');

    return view('home.cart', compact('carts', 'provinsi', 'cart_total'));
}


public function checkout_orders(Request $request)
{
    try {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'id_member' => 'required|integer',
            'nama_barang' => 'required',
            'grand_total' => 'required|numeric|min:0',
            'id_produk' => 'required|array',
            'id_produk.*' => 'required|integer',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
            'total' => 'required|array',
            'total.*' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Memasukkan data order baru ke dalam tabel orders
        $id = DB::table('orders')->insertGetId([
            'id_member' => $request->id_member,
            'nama_barang' => $request->nama_barang,
            'invoice' => date('ymds'), // Contoh pembuatan invoice sederhana
            'grand_total' => $request->grand_total,
            'status' => 'Baru',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Memasukkan detail order ke dalam tabel orders_details
        for ($i = 0; $i < count($request->id_produk); $i++) {
            DB::table('orders_details')->insert([
                'id_order' => $id,
                'nama_barang' => $request->nama_barang,
                'id_produk' => $request->id_produk[$i],
                'jumlah' => $request->jumlah[$i],
                'total' => $request->total[$i],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Hapus data dari keranjang (cart)
        Cart::where('id_member', $request->id_member)->delete();

        return response()->json(['success' => true, 'message' => 'Order placed successfully.']);

    } catch (\Exception $e) {
        // Tangani kesalahan dengan log dan respons error
        Log::error('Error checkout order: ' . $e->getMessage());
        return response()->json(['error' => 'Terjadi kesalahan saat melakukan checkout.'], 500);
    }
}



public function get_kota ($id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 1dc1002793a890f90a69835a2c9858e4"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}
public function checkout()
{
    try {
        // Mengambil ID pengguna yang sedang login
        $userId = Auth::guard('webmember')->user()->id;

        // Mengambil pesanan untuk member dengan ID tertentu
        $orders = Order::where('id_member', $userId)->get();

        // Ambil data tentang
        $about = About::first();

        // Ambil data member yang sedang login
        $member = Member::find($userId);

        // Ambil data provinsi dari API RajaOngkir
        $apiKey = "1dc1002793a890f90a69835a2c9858e4";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $apiKey
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new \Exception('cURL Error: ' . $err);
        }

        $provinsi = json_decode($response, true)['rajaongkir']['results'];

        return view('home.checkout', compact('about', 'orders', 'provinsi', 'member'));
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
    }
}



public function pesanan_selesai(Order $order)
{
    $order->status = 'Selesai';
    $order->save();
    return redirect('/orders');
}
public function orders()
{
    // Ambil user yang sedang login
    $user = Auth::guard('webmember')->user();

    // Ambil data orders berdasarkan id_member, mengambil yang paling baru (berdasarkan id terbesar)
    $orders = Order::where('id_member', $user->id)
                   ->orderBy('id', 'desc')
                   ->get();

    // Ambil data payments berdasarkan nama_member
    $payments = Payment::where('nama_member', $user->nama_member)->get();

    // Kirim data orders dan payments ke view
    return view('home.orders', compact('orders', 'payments'));
}




    public function about ()
    {
        $about = About::first();
        $testimonis = Testimoni::all();
        return view('home.about', compact('about', 'testimonis'));
    }

    public function delete_from_Cart(cart $cart)
    {
        $cart->delete(); // Menghapus item keranjang yang spesifik
        return redirect('/cart');
    }
    
    public function contact ()
    {
        $about = About::first();
        return view('home.contact', compact('about'));
    }

    public function faq ()
    {
        return view('home.faq');
    }
}

