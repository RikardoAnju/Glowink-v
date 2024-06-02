<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\cart;
use App\Models\Category;
use App\Models\product;
use App\Models\slider;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
   

    $carts = Cart::where('id_member', Auth::guard('webmember')->user()->id)->get();
    $cart_total = Cart::where('id_member', Auth::guard('webmember')->user()->id)->sum('total');
    return view('home.cart', compact('carts','provinsi', 'cart_total'));
}

public function get_ongkir( $destination, $weight)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=22&destination=".$destination."&weight=".$weight."&courier=jne", // Menambahkan "&courier=jne" untuk menentukan kurir
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 1dc1002793a890f90a69835a2c9858e4" // Menghapus spasi setelah kunci API
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      // Menangani kesalahan curl
      return "cURL Error #: " . $err;
    } else {
      // Mengembalikan hasil respons dalam format array
      return json_decode($response, true);
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

    public function checkout ()
    {
        return view('home.checkout');
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

