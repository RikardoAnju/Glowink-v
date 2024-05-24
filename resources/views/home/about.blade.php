@extends('layout.home')
@section('title', 'About')
@section('content')
    <!-- Intro -->
    <section class="section-wrap intro pb-0">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 mb-50">
            <h2 class="intro-heading">about our shop</h2>
            <p>{{ $about->deskripsi }}</p>
          </div>
        </div>
        <hr class="mb-0">
      </div>
    </section> <!-- end intro -->

    <!-- Our Team -->
    <section class="section-wrap pb-40 our-team">
      <div class="container">

        <div class="row heading-row">
          <div class="col-md-12 text-center">
            <span class="subheading">Who We Are</span>
            <h2 class="heading bottom-line">
              meet our team
            </h2>
          </div>
        </div>

        <div class="row">

          <div class="col-sm-3 col-xs-6 col-xxs-12 mb-40">
            <div class="team-wrap">
              <div class="team-member">
                <div class="team-img hover-trigger">
                  <img src="/front/img/team/team_1.jpg" alt="">
                </div>
                <div class="team-details text-center">                
                  <h4 class="team-title">Name</h4>
                  <span>#</span>
                  <div class="social-icons rounded">
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div> 
                </div>                            
              </div>
            </div>
          </div> <!-- end team member -->

          <div class="col-sm-3 col-xs-6 col-xxs-12 mb-40">
            <div class="team-wrap">
              <div class="team-member">
                <div class="team-img hover-trigger">
                  <img src="/front/img/team/team_2.jpg" alt="">
                </div>
                <div class="team-details text-center">
                  <h4 class="team-title">name</h4>
                  <span>#</span>
                  <div class="social-icons rounded">
                    <a href="/front/#"><i class="fa fa-twitter"></i></a>
                    <a href="/front/#"><i class="fa fa-facebook"></i></a>
                    <a href="/front/#"><i class="fa fa-google-plus"></i></a>
                    <a href="/front/#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>                                
              </div>
            </div>
          </div> <!-- end team member -->

          <div class="col-sm-3 col-xs-6 col-xxs-12 mb-40">
            <div class="team-wrap">
              <div class="team-member">
                <div class="team-img hover-trigger">
                  <img src="/front/img/team/team_3.jpg" alt="">
                </div>
                <div class="team-details text-center">
                  <h4 class="team-title">name</h4>
                  <span>Marketing Officer</span>
                  <div class="social-icons rounded">
                    <a href="/front/#"><i class="fa fa-twitter"></i></a>
                    <a href="/front/#"><i class="fa fa-facebook"></i></a>
                    <a href="/front/#"><i class="fa fa-google-plus"></i></a>
                    <a href="/front/#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>                               
              </div>
            </div>
          </div> <!-- end team member -->

          <div class="col-sm-3 col-xs-6 col-xxs-12 mb-40">
            <div class="team-wrap">
              <div class="team-member">
                <div class="team-img hover-trigger">
                  <img src="/front/img/team/team_4.jpg" alt="">
                </div>
                <div class="team-details text-center">
                  <h4 class="team-title">name</h4>
                  <span>Photographer</span>
                  <div class="social-icons rounded">
                    <a href="/front/#"><i class="fa fa-twitter"></i></a>
                    <a href="/front/#"><i class="fa fa-facebook"></i></a>
                    <a href="/front/#"><i class="fa fa-google-plus"></i></a>
                    <a href="/front/#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>                               
              </div>
            </div>
          </div> <!-- end team member -->

        </div>

      </div>
    </section> <!-- end our team -->

    <!-- Promo Section -->
    <section class="section-wrap promo-bg" style="background-image:url(/front/img/promo_2_bg.jpg);">
      <div class="container text-center">
        <div class="table-box">
          <h2 class="heading-frame white">The best ideas</h2>
        </div>
      </div>
    </section> <!-- end promo section -->

    <!-- Testimonials -->
    <section class="section-wrap testimonials">
      <div class="container">

        <div class="row heading-row mb-20">
          <div class="col-md-6 col-md-offset-3 text-center">
            <span class="subheading">Hot Customers</span>
            <h2 class="heading bottom-line">Happy Clients</h2>
          </div>
        </div>

        <div id="owl-testimonials" class="owl-carousel owl-theme owl-dark-dots text-center">
          @foreach ($testimonis as $Testimoni)
           
          <div class="item">
            <div class="testimonial">
              <p class="testimonial-text">{{ $Testimoni->deskripsi }}</p>
              <span>{{ $Testimoni->nama_testimoni }}</span>
            </div>
          </div>
          
          @endforeach

    </section> <!-- end testimonials -->


@endsection