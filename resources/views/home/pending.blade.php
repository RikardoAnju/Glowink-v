@extends('layout.home')
@section('title', 'Payment Pending')
@section('content')
<section class="section-wrap pb-70">
  <div class="container text-center">
    <div class="row">
      <div class="col-xs-12">
        <div class="checkout-confirmation">
          <h1>Payment Pending</h1>
          <p>Your payment is being processed. We will notify you once it is confirmed.</p>
          <a href="{{ route('home') }}" class="btn btn-lg btn-dark">Return to Home</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
