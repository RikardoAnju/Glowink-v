<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\product;
use App\Models\slider;
use illuminate\Support\Str;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    if (!Auth::guard('webmember')->user()) {
        return redirect('/login_member');
    }

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
        echo "cURL Error #:" . $err;
    }
    
    $provinsi = json_decode($response);
   

    $carts = Cart::where('id_member', Auth::guard('webmember')->user()->id)->where('is_checkout',0)->get();
    $cart_total = Cart::where('id_member', Auth::guard('webmember')->user()->id)->where('is_checkout',0)->sum('total');
    return view('home.cart', compact('carts','provinsi', 'cart_total'));
}

public function checkout_orders(Request $request)
{
    // Memasukkan data order baru ke dalam tabel orders
    $id = DB::table('orders')->insertGetId([
        'id_member' => $request->id_member,
        'invoice' => date('ymds'),
        'grand_total' => $request->grand_total,
        'status' => 'Baru',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Memasukkan detail order ke dalam tabel orders_details
    for ($i = 0; $i < count($request->id_produk); $i++) {
        DB::table('orders_details')->insert([
            'id_order' => $id,
            'id_produk' => $request->id_produk[$i],
            'jumlah' => $request->jumlah[$i], 
            'total' => $request->total[$i],
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    Cart::where('id_member', Auth::guard('webmember')->user()->id)->update([
        'is_checkout' => 1
    ]);

    return response()->json(['success' => true, 'message' => 'Order placed successfully.']);
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
    $about = About::first(); // Ambil data tentang
    $user_id = Auth::guard('webmember')->user()->id; // Ambil ID user yang sedang login
    
    // Ambil data provinsi dari API RajaOngkir
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
        $provinsi = []; // Inisialisasi provinsi sebagai array kosong
        echo "cURL Error #:" . $err;
    } else {
        $provinsi = json_decode($response);
    }
    
    // Ambil pesanan untuk user yang login
    $orders = Order::where('id_member', $user_id)->get();

    return view('home.checkout', compact('about', 'orders', 'provinsi'));
}


public function payments(Request $request)
{
    Payment::create([
        'id_order' => $request->id_order, // Perbaiki nama kolom
        'jumlah' => $request->jumlah_transfer,
        'provinsi' => $request->provinsi,
        'kabupaten' => $request->kota,
        'kecamatan' => "", // Jika tidak digunakan, Anda bisa mengosongkannya
        'detail_alamat' => $request->detail_alamat,
        'status' => 'pending',
        'no_rekening' => $request->no_rekening,
        'atas_nama' => $request->atas_nama,
    ]);

    return redirect('/orders');
}


    public function orders ()
    {
        return view('home.orders');
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
    

    //public function add_to_cart(Request $request)
//{
    // Validasi data yang diterima dari permintaan POST
   // $validatedData = $request->validate([
    //    'id_member' => 'required',
        //'id_barang' => 'required',
       // 'jumlah' => 'required|integer|min:1',
       // 'total' => 'required|numeric|min:0',
       // 'is_checkout' => 'required|boolean',
   // ]);

    // Simpan data ke dalam database
   // $cart = Cart::create($validatedData);

    // Response success
    //return response()->json(['message' => 'Data berhasil ditambahkan ke dalam keranjang.']);
//}
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

