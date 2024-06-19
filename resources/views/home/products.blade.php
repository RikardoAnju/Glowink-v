<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@section('title', 'List Products')</title>
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,400i,600,700' rel='stylesheet'>

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Favicons -->
  <link rel="shortcut icon" href="images/logo.png">
  <link rel="apple-touch-icon" href="images/logo.png">
  <link rel="apple-touch-icon" sizes="200x200" href="images/logo.png">
  <link rel="apple-touch-icon" sizes="200x200" href="images/logo.png">

  <!-- Custom Styles -->
  <style>
    .product:hover .product-img img {
      filter: blur(5px);
      transition: filter 0.3s ease-in-out;
    }
    .product-quickview {
      transition: background-color 0.3s ease-in-out;
    }
    .product-quickview:hover {
      background-color: #D4AF37; /* Coklat keemasan */
    }
  </style>
</head>
<body>
  <section class="pt-20 pb-10 catalogue">
    <div class="container mx-auto">
      <!-- Filter -->          

      <form class="ecommerce-ordering mb-10">
        <div class="flex justify-between items-center">
          <div class="flex">
            <!-- Filter and sorting options here -->
          </div>
          <div class="flex">
            <a href="#" class="text-gray-600 hover:text-gray-900">
              <i class="fa fa-shopping-cart"></i> 
            </a>
          </div>
        </div>
      </form>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($products as $product)
        <div class="product border p-4 rounded-lg shadow hover:shadow-lg transition duration-200">
          <div class="product-img mb-4 relative">
            <a href="/product/{{ $product->id }}">
              <img src="{{ asset($product->gambar) }}" alt="" class="w-full h-64 object-cover mb-2">
            </a>
            <a href="/product/{{ $product->id }}" class="product-quickview absolute bottom-0 left-0 w-full text-center py-2 bg-gray-800 hover:bg-gray-700 text-white transition duration-300">More</a>
          </div>
          <div class="product-details text-left">
            <h3 class="product-title text-xl font-semibold mb-2">
              <a href="/product/{{ $product->id }}" class="hover:text-gray-700">{{ $product->nama_barang }}</a>
            </h3>
            <span class="category text-gray-500 text-sm">
              <a href="/products/{{ $product->id_subkategori }}" class="hover:text-gray-700">{{ $product->subcategory->nama_subkategori }}</a>
            </span>
            <div class="price mt-4">
              <span class="amount text-lg font-semibold text-gray-800">Rp.{{ number_format($product->harga) }}</span>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </section>
  <!-- jQuery Scripts -->
  <script type="text/javascript" src="front/js/jquery.min.js"></script>
  <script type="text/javascript" src="front/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="front/js/plugins.js"></script>  
  <script type="text/javascript" src="front/js/scripts.js"></script>
</body>
</html>
