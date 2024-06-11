@extends('layout.home')
@section('title', 'Checkout')
@section('content')
<!-- Checkout -->
<section class="section-wrap checkout pb-70">
  <div class="container relative">
    <div class="row">
      <div class="ecommerce col-xs-12">
        <form name="checkout" id="checkout" class="checkout ecommerce-checkout row" method="POST" action="{{ route('payments.create') }}">
          @csrf
          <input type="hidden" name="id_order" value="{{ $orders->id }}">
          <input type="hidden" name="nama_member" value="{{ $members->nama_member }}">
          <input type="hidden" name="email" value="{{ $members->email }}">
          <input type="hidden" name="total" id="total" value="{{ $orders->grand_total }}">

          <div class="col-md-8" id="customer_details">
            <h2 class="heading uppercase bottom-line full-grey mb-30">Billing Address</h2>
            <p>
              <label for="provinsi">Provinsi <abbr class="required" title="required">*</abbr></label>
              <select name="provinsi" id="provinsi" class="country_to_state provinsi" required>
                <option value="">Pilih Provinsi</option>
                @foreach ($provinsi->rajaongkir->results as $prov)
                  <option value="{{ $prov->province_id }}">{{ $prov->province }}</option>
                @endforeach
              </select>
            </p>
            <p>
              <label for="kabupaten">Kota <abbr class="required" title="required">*</abbr></label>
              <select name="kabupaten" id="kabupaten" class="country_to_state provinsi kota" required>
                <option value="">Pilih Kota</option>
              </select>
            </p>
            <p>
              <label for="detail_alamat">Detail Alamat <abbr class="required" title="required">*</abbr></label>
              <textarea class="input-text" name="detail_alamat" id="detail_alamat" required></textarea>
            </p>
            <div class="clear"></div>
          </div> <!-- end col -->

          <div class="col-md-4">
            <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
              <h2 class="heading uppercase bottom-line full-grey">Your Order</h2>
              <table class="table shop_table ecommerce-checkout-review-order-table">
                <tbody>
                  <tr>
                    <th><strong>Order Total</strong></th>
                    <td><strong><span id="order_total" class="amount">Rp. {{ number_format($orders->grand_total, 0, ',', '.') }}</span></strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div><!-- end order review -->

          <div class="col-md-12">
            <div class="form-row place-order">
              <button type="button" class="btn btn-lg btn-dark" id="place_order">Place order</button>
            </div>
          </div>
        </form>
      </div> <!-- end ecommerce -->
    </div> <!-- end row -->
  </div> <!-- end container -->
</section> <!-- end checkout -->

@push('js')
<script>
$(document).ready(function() {
  $('#provinsi').change(function() {
    var selectedProvinsi = $(this).val();
    if (selectedProvinsi != "") {
      $.ajax({
        url: '/get_kota/' + selectedProvinsi,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          if (data.rajaongkir.status.code === 200) {
            var kotaOptions = '<option value="">Pilih Kota</option>';
            $.each(data.rajaongkir.results, function(index, kota) {
              kotaOptions += '<option value="' + kota.city_id + '">' + kota.city_name + '</option>';
            });
            $('#kabupaten').html(kotaOptions);
            updateTotal();
          }
        }
      });
    } else {
      $('#kabupaten').html('<option value="">Pilih Kota</option>');
      updateTotal();
    }
  });

  $('#kabupaten').change(function() {
    updateTotal();
  });

  $('#place_order').click(function(e) {
    e.preventDefault();
    var provinsi = $('#provinsi').val();
    var kabupaten = $('#kabupaten').val();
    var detail_alamat = $('#detail_alamat').val();
    if (provinsi == "" || kabupaten == "" || detail_alamat == "") {
      alert("Mohon lengkapi semua field yang diperlukan.");
      return false;
    }

    $.ajax({
      url: "{{ route('payments.create') }}",
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        provinsi: provinsi,
        kabupaten: kabupaten,
        detail_alamat: detail_alamat,
        nama_member: "{{ $members->nama_member }}",
        email: "{{ $members->email }}",
        total: $('#total').val()
      },
      success: function(response) {
        if (response.token && response.checkout_url) {
          window.location.href = response.checkout_url;
        } else if (response.redirect_url) {
          window.location.href = response.redirect_url;
        } else {
          alert("Gagal memproses pembayaran. Silakan coba lagi.");
        }
      },
      error: function(response) {
        console.log(response);
        alert("Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.");
      }
    });
  });

  function updateTotal() {
    var total = parseFloat("{{ $orders->grand_total }}");
    $('#order_total').text("Rp. " + total.toLocaleString('id-ID'));
  }
});
</script>
@endpush
@endsection
