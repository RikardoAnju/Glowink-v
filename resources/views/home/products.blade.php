<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@section('title', ' List Products')</title>
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,400i,600,700' rel='stylesheet'>

  <!-- Css -->
  <link rel="stylesheet" href="/front/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/front/css/magnific-popup.css" />
  <link rel="stylesheet" href="/front/css/font-icons.css" />
  <link rel="stylesheet" href="/front/css/sliders.css" />
  <link rel="stylesheet" href="/front/css/style.css" />

  <!-- Favicons -->
  <link rel="shortcut icon" href="images/logo.png">
  <link rel="apple-touch-icon" href="images/logo.png">
  <link rel="apple-touch-icon" sizes="200x200" href="images/logo.png">
  <link rel="apple-touch-icon" sizes="200x200" href="images/logo.png">

</head>
<body>
  <section class="section-wrap pt-80 pb-40 catalogue">
    <div class="container relative">
  
      <!-- Filter -->          
      <div class="shop-filter">
        <div class="view-mode hidden-xs">
          <span>View:</span>
          <a class="grid grid-active" id="grid"></a>
          <a class="list" id="list"></a>
        </div>
        <div class="filter-show hidden-xs">
          <span>Show:</span>
          <a href="#" class="active">12</a>
          <a href="#">24</a>
          <a href="#">all</a>
        </div>
        <form class="ecommerce-ordering">
          <select>
            <option value="default-sorting">Default Sorting</option>
            <option value="price-low-to-high">Price: high to low</option>
            <option value="price-high-to-low">Price: low to high</option>
            <option value="by-popularity">By Popularity</option>
            <option value="date">By Newness</option>
            <option value="rating">By Rating</option>
          </select>
        </form>
      </div>
  
      <div class="row">
        <div class="col-md-12 catalogue-col right mb-50">
          <div class="shop-catalogue grid-view">
  
            <div class="row items-grid">

              @foreach ($products as $product)
                  
              <div class="col-md-4 col-xs-6 product product-grid">
                <div class="product-item clearfix">
             
                  <div class="product-img hover-trigger">
                    <a href="/product/{{ $product->id }}">
                      <img src="{{ asset($product->gambar) }}" alt="">
                      <img src="{{ asset($product->gambar) }}" alt="" class="back-img">
                    </a>
                    <div class="hover-2">                    
                      <div class="product-actions">
                        <a href="#" class="product-add-to-wishlist">
                          <i class="fa fa-heart"></i>
                        </a>
                      </div>                        
                    </div>
                    <a href="/product/{{ $product->id }}" class="product-quickview">More</a>
                  </div>
  
                  <div class="product-details">
                    <h3 class="product-title">
                      <a href="/product/{{ $product->id }}">{{ $product->nama_barang }}</a>
                    </h3>
                    <span class="category">
                      <a href="/productS/{{ $product->id_subkategori }}">{{ $product->subcategory->nama_subkategori }}</a>
                    </span>
                  </div>
  
                  <span class="price">
                    <ins>
                      <span class="amount">Rp.{{ number_format($product->harga) }}</span>
                    </ins>                        
                  </span>
                </div>
              </div>
              @endforeach
  
            </div> 
          </div> 
          
          <!-- Pagination -->
          <div class="pagination-wrap clearfix">
            <p class="result-count">Showing: 12 of 80 results</p>                 
            <nav class="pagination right clearfix">
              <a href="#"><i class="fa fa-angle-left"></i></a>
              <span class="page-numbers current">1</span>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              <a href="#"><i class="fa fa-angle-right"></i></a>
            </nav>
          </div>
  
        </div> <!-- end col -->
  
      </div> <!-- end row -->
    </div> <!-- end container -->
  </section> <!-- end catalog -->
  <!-- jQuery Scripts -->
  <script type="text/javascript" src="front/js/jquery.min.js"></script>
  <script type="text/javascript" src="front/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="front/js/plugins.js"></script>  
  <script type="text/javascript" src="front/js/scripts.js"></script>
</body>
</html>