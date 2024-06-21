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
          
          <input type="hidden" name="order_id" value="{{ Illuminate\Support\Str::uuid()->toString() }}">
          <input type="hidden" name="nama_member" value="{{ $member->nama_member }}">
          <input type="hidden" name="nama_barang" value="{{ $orders->first()->nama_barang }}">
          <input type="hidden" name="email" value="{{ $member->email }}">
          <input type="hidden" name="grand_total" id="grand_total" value="{{ $orders->last()->grand_total }}">
          <input type="hidden" name="provinsi" value="">
          <input type="hidden" name="kabupaten" value="">

          <div class="col-md-8" id="customer_details">
            <h2 class="heading uppercase bottom-line full-grey mb-30">Billing Address</h2>
            <p>
              <label for="provinsi">Provinsi <abbr class="required" title="required">*</abbr></label>
              <select name="provinsi" id="provinsi" class="country_to_state provinsi" rel="calc_shipping_state">
                <option value="" data-province-name="">Pilih Provinsi</option>
                @foreach ($provinsi as $prov)
                <option value="{{ $prov['province_id'] }}" data-province-name="{{ $prov['province'] }}">{{ $prov['province'] }}</option>
                @endforeach
              </select>
            </p>
            <p>
              <label for="kabupaten">Kota <abbr class="required" title="required">*</abbr></label>
              <select name="kabupaten" id="kabupaten" class="country_to_state provinsi kota" required>
                <option value="" data-city-name="">Pilih Kota</option>
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
                    <th>Order Total</th>
                    <td class="amount">Rp.{{ number_format($orders->last()->grand_total, 0, ',', '.') }}</td>
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

@endsection

@push('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-4Lymuq91xf7MtA6u"></script>

<script>
$(document).ready(function() {
  $('#provinsi').change(function () {
    var selectedProvinsi = $(this).val();
    if (selectedProvinsi != "") {
      $.ajax({
        url: '/get_kota/' + selectedProvinsi,
        success: function (data) {
          data = JSON.parse(data);
          var option = "<option value='' data-city-name=''>Pilih Kota</option>";
          data.rajaongkir.results.map(function (kota) {
            option += "<option value=" + kota.city_id + " data-city-name=" + kota.city_name + ">" + kota.city_name + "</option>";
          });
          $('#kabupaten').html(option);
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          alert('Failed to retrieve city data. ' + error);
        }
      });
    } else {
      $('#kabupaten').html("<option value='' data-city-name=''>Pilih Kota</option>");
    }
  });

  $('#place_order').click(function(event) {
    event.preventDefault();

    var selectedProvinsiName = $('#provinsi option:selected').data('province-name');
    var selectedKabupatenName = $('#kabupaten option:selected').data('city-name');

    $('input[name="provinsi"]').val(selectedProvinsiName);
    $('input[name="kabupaten"]').val(selectedKabupatenName);

    $.ajax({
      url: $('#checkout').attr('action'),
      type: $('#checkout').attr('method'),
      data: $('#checkout').serialize(),
      success: function(response) {
        if (response.checkout_url) {
          snap.pay(response.token, {
            onSuccess: function(result) {
              window.location.href = '{{ route("payment.success") }}';
            },
            onPending: function(result) {
              window.location.href = '{{ route("payment.pending") }}';
            },
            onError: function(result) {
              window.location.href = '{{ route("payment.error") }}';
            }
          });
        } else {
          alert("Gagal memproses pembayaran. Silakan coba lagi.");
        }
      },
      error: function(response) {
        alert("Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.");
      }
    });
  });

  // Menangani navigasi mundur di browser
  history.pushState(null, null, location.href);
  window.onpopstate = function () {
    history.go(1);
  };

});
</script>
@endpush
