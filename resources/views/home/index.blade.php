@extends('layout.home')

@section('content')
<style>
    .fixed-size-wrapper {
        width: 100%;
        height: 250px; /* Adjust height as needed */
        overflow: hidden;
        position: relative;
    }

    .fixed-size {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .hero-slide {
        height: 600px; /* Adjust height as needed */
        background-size: cover;
        background-position: center;
    }

    .hover-overlay {
        background-color: rgba(0, 0, 0, 0.5); /* Optional: Add background color on hover */
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .product-item:hover .hover-overlay {
        opacity: 1;
    }
</style>

    <!-- Hero Slider -->
    <section class="hero-wrap text-center relative">
        <div id="owl-hero" class="owl-carousel owl-theme light-arrows slider-animated">
            
            @foreach ($sliders as $slider)    
                <div class="hero-slide overlay" style="background-image: url('{{ asset($slider->gambar) }}')">
                    <div class="container">
                        <div class="hero-holder">
                            <div class="hero-message">
                                <h1 class="hero-title nocaps">{{ $slider->nama_slider }}</h1>
                                <h2 class="hero-subtitle lines">{{ $slider->deskripsi }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section> <!-- end hero slider -->
    
    <!-- Promo Banners -->
    <section class="section-wrap promo-banners pb-30">
        <div class="container">
            <div class="row">
                <h2 class="heading bottom-line items-center text-center text-3xl">
                    Category
                   </h2>
                @foreach ($categories as $category)   
                    <div class="col-xs-12 col-sm-6 col-md-4 mb-30 promo-banner">
                        <a href="/products/{{ $category->id }}" class="d-block position-relative">
                            <div class="fixed-size-wrapper">
                                <img class="fixed-size img-fluid" src="{{ asset($category->gambar) }}" alt="">
                                <div class="overlay position-absolute w-100 h-100 top-0 start-0"></div>
                                <div class="promo-inner valign position-absolute w-100 h-100 top-0 start-0 d-flex justify-content-center align-items-center">
                                    <div class="text-center">
                                        <h2>{{ $category->nama_kategori }}</h2>
                                        <span>{{ $category->deskripsi }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>                        
                    </div> 
                @endforeach
            </div>
        </div>
    </section> <!-- end promo banners -->

    <!-- Trendy Products -->
    <section class="section-wrap-sm new-arrivals pb-50">
        <div class="container">
            <div class="row heading-row">
                <div class="col-md-12 text-center">
                    {{-- <span class="subheading">Hot items of this year</span> --}}
                    <h2 class="heading bottom-line">
                     Products
                    </h2>
                </div>
            </div>

            <div class="row items-grid"> 
                @foreach ($products as $product)    
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="product-item hover-trigger position-relative">
                            <div class="fixed-size-wrapper">
                                <a href="/product/{{ $product->id }}">
                                    <img class="fixed-size img-fluid" src="{{ asset($product->gambar) }}" alt="">
                                </a>
                                <div class="hover-overlay position-absolute w-100 h-100 top-0 start-0 d-flex justify-content-center align-items-center">
                                    <div class="product-actions">
                                        <a href="" class="product-add-to-cart me-2">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <a href="" class="product-add-to-wishlist">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="product-details valign text-center">
                                        <span class="category">
                                            <a href="/products/{{ $product->id_subkategori }}">{{ $product->subcategory->nama_subkategori }}</a>
                                        </span>
                                        <h3 class="product-title">
                                            <a href="/product/{{ $product->id }}">{{ $product->nama_barang }}</a>
                                        </h3>
                                        <span class="price">
                                            <ins>
                                                <span class="amount">Rp.{{ number_format($product->harga) }}</span>
                                            </ins>
                                        </span>
                                        <div class="btn-quickview mt-2">
                                            <a href="/product/{{ $product->id }}" class="btn btn-md btn-color">
                                                <span>More</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach             
            </div> <!-- end row -->
        </div>
    </section> <!-- end trendy products -->
@endsection
