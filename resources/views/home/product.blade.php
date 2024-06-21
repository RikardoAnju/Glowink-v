<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Product')</title>
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,400i,600,700' rel='stylesheet'>
  <!-- CSS -->
  <link rel="stylesheet" href="/front/css/bootstrap.min.css">
  <link rel="stylesheet" href="/front/css/magnific-popup.css">
  <link rel="stylesheet" href="/front/css/font-icons.css">
  <link rel="stylesheet" href="/front/css/sliders.css">
  <link rel="stylesheet" href="/front/css/style.css">
  <!-- Favicons -->
  <link rel="shortcut icon" href="images/logo.png">
  <link rel="apple-touch-icon" href="images/logo.png">
  <link rel="apple-touch-icon" sizes="200x200" href="images/logo.png">
  <link rel="apple-touch-icon" sizes="200x200" href="images/logo.png">
</head>
<body>

<!-- Single Product -->
<header class="nav-type-1">
  <!-- Fullscreen search -->
  <div class="search-wrap">
    <div class="search-inner">
      <div class="search-cell">
        <form method="get">
          <div class="search-field-holder">
            <input type="search" class="form-control main-search-input" placeholder="Search for">
            <i class="ui-close search-close" id="search-close"></i>
          </div>            
        </form>
      </div>
    </div>        
  </div> <!-- end fullscreen search -->

  <nav class="navbar navbar-static-top">
    <div class="navigation" id="sticky-nav">
      <div class="container relative">
        <div class="row flex-parent">

          <div class="navbar-header flex-child">
            <!-- Logo -->
            <div class="logo-container">
              <div class="logo-wrap">
                <a href="/">
                  <h1>Glowink</h1>
                </a>
              </div>
            </div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Mobile cart -->
            <div class="nav-cart mobile-cart hidden-lg hidden-md">
              <div class="nav-cart-outer">
                <div class="nav-cart-inner">
                  <a href="/front/#" class="nav-cart-icon">
                    <span class="nav-cart-badge">2</span>
                  </a>
                </div>
              </div>
            </div>
          </div> 

          <div class="nav-wrap flex-child">
            <div class="collapse navbar-collapse text-center" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown"><a href="/">Home</a></li>
                <li class="dropdown"><a href="/about">About</a></li>
                @php
                    $categories = App\Models\Category::all();
                @endphp
                <li class="dropdown">
                  <a href="#">Shop</a>
                  <i class="fa fa-angle-down dropdown-trigger"></i>
                  <ul class="dropdown-menu megamenu-wide">
                    <li>
                      <div class="megamenu-wrap container">
                        <div class="row">                       
                          @foreach ($categories as $category)
                          <div class="col-md-3 megamenu-item">
                            <ul class="menu-list">     
                              <li>
                                <span>{{ $category->nama_kategori }}</span>
                              </li>
                              @php
                              $subcategories = App\Models\Subcategory::where('id_kategori', $category->id)->get();
                              @endphp
                              @foreach ($subcategories as $subcategory)     
                              <li>
                                <a href="/products/{{ $subcategory->id }}">{{ $subcategory->nama_subkategori }}</a>
                              </li>  
                              @endforeach
                            </ul>
                          </div>
                          @endforeach
                        </div> 
                      </div>
                    </li>
                  </ul>
                </li>
               
                <!-- Mobile search -->
                <li id="mobile-search" class="hidden-lg hidden-md">
                  <form method="get" class="mobile-search">
                    <input type="search" class="form-control" placeholder="Search...">
                    <button type="submit" class="search-button">
                      <i class="fa fa-search"></i>
                    </button>
                  </form>
                </li>
              </ul> <!-- end menu -->
            </div> <!-- end collapse -->
          </div> <!-- end col -->
          <div class="flex-child flex-right nav-right hidden-sm hidden-xs">
            <ul>
                <li class="nav-register">
                    @if (Auth::guard('webmember')->check())
                        <a href="/profile">{{ Auth::guard('webmember')->user()->nama_member }}</a>
                    @else
                        <a href="/login_member">Login</a>
                    @endif
                </li>
                <li class="nav-search-wrap style-2 hidden-sm hidden-xs">
                    <a href="#" class="nav-search search-trigger">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <li class="nav-cart">
                    <div class="nav-cart-outer">
                        <div class="nav-cart-inner">
                            <a href="/cart" class="nav-cart-icon"></a>
                        </div>
                    </div>
                </li>
                <li class="nav-register">
                  @if (Auth::guard('webmember')->check())
                      <a href="/logout_member">Logout</a>
                  @endif
              </li>
            </ul>
        </div>
        </div> <!-- end row -->
        
      </div> <!-- end container -->
    </div>
  </nav>
</header> <!-- end header -->

<section class="section-wrap pb-40 single-product">
  <div class="container-fluid semi-fluid">
    <div class="row">

      <!-- Col img slider -->
      <div class="col-md-6 col-xs-12 product-slider mb-60">
        <div class="flickity flickity-slider-wrap mfp-hover" id="gallery-main">
          <div class="gallery-cell">
            <a href="{{ asset($product->gambar) }}" class="lightbox-img">
              <img src="{{ asset($product->gambar) }}" alt="" />
              <i class="ui-zoom zoom-icon"></i>
            </a>
          </div>
        </div> <!-- end gallery main -->
        <div class="gallery-thumbs">
          <!-- Gallery thumbs -->
        </div> <!-- end gallery thumbs -->
      </div> <!-- end col img slider -->

      <!-- Col product description -->
      <div class="col-md-6 col-xs-12 product-description-wrap">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li><a href="/products/{{ $product->id_subkategori }}">{{ $product->subcategory->nama_subkategori }}</a></li>
          <li class="active">Catalog</li>
        </ol>
        <!-- Product Title -->
        <h1 class="product-title">{{ $product->nama_barang }}</h1>              
        <!-- Product Price -->
        <span class="price">
          <ins>
            <span class="amount">Rp.{{ number_format($product->harga) }}</span>
          </ins>
        </span>
        <!-- Short Description -->
        {{-- <p class="short-description">{{ $product->deskripsi }}</p> --}}

        <!-- Product Actions -->
        <div class="product-actions">
          <span>Qty:</span>
          <div class="quantity buttons_added">                  
            <input type="number" step="1" min="1" value="1" title="Qty" class="input-text jumlah qty text" />

            <div class="quantity-adjust">
              <a href="#" class="plus">
                <i class="fa fa-angle-up"></i>
              </a>
              <a href="#" class="minus">
                <i class="fa fa-angle-down"></i>
              </a>
            </div>
          </div>
          <a href="#" class="btn btn-dark btn-lg add-to-cart"><span>Add to Cart</span></a>
          {{-- <a href="#" class="product-add-to-wishlist"><i class="fa fa-heart"></i></a>                           --}}
        </div>

        <!-- Product Meta -->
        <div class="product_meta">
          <span class="sku">SKU: <a href="#">{{ $product->sku }}</a></span>
          <span class="brand_as">Category: <a href="#">{{ $product->category->nama_kategori }}</a></span>
          <span class="posted_in">Stok: <a href="#">{{ $product->stok }}</a></span>                
        </div>

        <!-- Accordion -->
        <div class="panel-group accordion mb-50" id="accordion">
          <div class="panel">
            <div class="panel-heading">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="minus">Description<span>&nbsp;</span></a>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">{{ $product->deskripsi }}</div>
            </div>
          </div>
          <div class="panel">
            <div class="panel-heading">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="plus">Information<span>&nbsp;</span></a>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">
                <table class="table shop_attributes">
                  <tbody>
                    <tr>
                      <th>Ukuran:</th>
                      <td>{{ $product->ukuran }}</td>
                    </tr>
                    <tr>
                      <th>Terbuat Dari:</th>
                      <td>{{ $product->bahan }}</td>
                    </tr>
                    <tr>
                      <th>Manfaat:</th>
                      <td>{{ $product->manfaat }}</td>
                    </tr>                                     
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Social Share -->
        <div class="socials-share clearfix">
          <span>Share:</span>
          <div class="social-icons nobase">
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-google"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
          </div>
        </div>
      </div> <!-- end col product description -->
    </div> <!-- end row -->
  </div> <!-- end container -->
</section> <!-- end single product -->

<!-- Related Products -->
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="/front/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/front/js/plugins.js"></script>  
<script type="text/javascript" src="/front/js/scripts.js"></script>

<script>
$(function(){
  $('.add-to-cart').click(function(e){
    e.preventDefault();

    var jumlah = $('.jumlah').val();

    if(jumlah <= 0 || isNaN(jumlah)) {
      alert('Jumlah barang harus lebih besar dari 0.');
      return;
    }

    @if (Auth::guard('webmember')->check())
      var id_member = {{ Auth::guard('webmember')->user()->id }};
      var id_barang = {{ $product->id }};
      var is_checkout = 1; // Set is_checkout ke 1 untuk menandai barang siap untuk checkout

      // Memeriksa apakah barang sudah ada di keranjang
      var itemExist = false;
      $('.cart-item').each(function() {
        var existingIdBarang = $(this).data('id-barang');
        if (existingIdBarang == id_barang) {
          var existingQty = parseInt($(this).find('.cart-qty').text());
          var newQty = existingQty + parseInt(jumlah);
          $(this).find('.cart-qty').text(newQty);
          itemExist = true;
          return false; // Keluar dari each loop
        }
      });

      // Jika barang belum ada di keranjang, tambahkan baru
      if (!itemExist) {
        $.ajax({
          url: '{{ route('add_to_cart') }}',
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
          },
          data: {
            id_member: id_member,
            id_barang: id_barang,
            jumlah: jumlah,
            is_checkout: is_checkout
          },
          success: function(data) {
            // Redirect ke halaman cart setelah berhasil ditambahkan ke keranjang
            window.location.href = '/cart';
          },
          error: function(xhr, status, error) {
            alert('Error: ' + xhr.responseJSON.error); // Menampilkan pesan error
            console.error(error);
          }
        });
      }

    @else
      // Redirect ke halaman login jika pengguna tidak login
      window.location.href = '/login_member';
    @endif
  });
});

</script>


</body>
</html>