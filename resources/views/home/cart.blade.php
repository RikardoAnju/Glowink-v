@extends('layout.home')

@section('title', 'Cart')

@section('content')

<!-- Cart -->
<section class="section-wrap shopping-cart">
  <div class="container relative">
    <div class="row">
      <form class="form-cart" action="/checkout_orders" method="POST">
        @csrf <!-- Direktif @csrf untuk token CSRF -->
        <input type="hidden" name="id_member" value="{{ Auth::guard('webmember')->user()->id }}">
        <input type="hidden" name="grand_total" id="grand_total" value="0"> <!-- Hidden input untuk grand_total -->

        <div class="col-md-12">
          <div class="table-wrap mb-30">
            <table class="shop_table cart table">
              <thead>
                <tr>
                  <th class="product-name" colspan="2">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-subtotal" colspan="2">Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($carts as $cart)
                  @if($cart->product)
                    <tr class="cart_item">
                      <td class="product-thumbnail">
                        <a href="#">
                          <img src="{{ asset($cart->product->gambar) }}" alt="">
                        </a>
                      </td>
                      <td class="product-name">
                        <a href="#">{{ $cart->product->nama_barang }}</a>
                        <ul>
                          <li>Ukuran: {{ $cart->product->ukuran }}</li>
                        </ul>
                      </td>
                      <td class="product-price">
                        <span class="amount">Rp.{{ number_format($cart->product->harga, 0, ',', '.') }}</span>
                      </td>
                      <td class="product-quantity">
                        {{ $cart->jumlah }}
                      </td>
                      <td class="product-subtotal">
                        <span class="amount">Rp.{{ number_format($cart->total, 0, ',', '.') }}</span>
                      </td>
                      <td class="product-remove">
                        <a href="/delete_from_cart/{{ $cart->id }}" class="remove" title="Remove this item">                          
                         <i class="ui-close"></i>
                        </a>
                      </td>
                    </tr>
                    <input type="hidden" name="id_produk[]" value="{{ $cart->product->id }}">
                    <input type="hidden" name="jumlah[]" value="{{ $cart->jumlah }}">
                    <input type="hidden" name="total[]" value="{{ $cart->total }}">
                    <input type="hidden" name="nama_barang" value="{{ $cart->product->nama_barang }}">
                  @else
                    <tr>
                      <td colspan="6" class="text-center">Product not found</td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="row mb-50">
            <div class="col-md-7 offset-md-5">
              <div class="actions">
                <div class="wc-proceed-to-checkout">
                  <button type="submit" class="btn btn-lg btn-dark"><span> Checkout</span></button>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- end col -->
      </form>
    </div> <!-- end row -->

    <div class="row">
      <div class="col-md-6 shipping-calculator-form">
        <h2 class="heading relative uppercase bottom-line full-grey mb-30">Calculate Shipping</h2>
        <p class="form-row form-row-wide">
          <select name="provinsi" id="provinsi" class="country_to_state provinsi" rel="calc_shipping_state">
            <option value="">Pilih Provinsi</option>
            @foreach ($provinsi as $prov)
              <option value="{{ $prov['province_id'] }}">{{ $prov['province'] }}</option>
            @endforeach
          </select>
        </p>
        <p class="form-row form-row-wide">
          <select name="kota" id="kota" class="country_to_state provinsi kota" rel="calc_shipping_state">
          </select>
        </p>

        <p>
          <a href="#" class="btn btn-lg btn-stroke mt-10 mb-mdm-40 update-total">
            Update Total
          </a>
        </p>

      </div> <!-- end col shipping calculator -->

      <div class="col-md-6">
        <div class="cart_totals">
          <h2 class="heading relative bottom-line full-grey uppercase mb-30">Cart Totals</h2>

          <table class="table shop_table">
            <tbody>
              <tr class="cart-subtotal">
                <th>Cart Subtotal</th>
                <td>
                  <span class="amount cart-total">Rp.{{ number_format($cart_total, 0, ',', '.') }}</span>
                </td>
              </tr>
              <tr class="shipping">
                <th>Shipping</th>
                <td>
                  <span class="amount shipping-cost">Rp.0</span> <!-- Shipping cost will be updated dynamically -->
                </td>
              </tr>
              <tr class="order-total">
                <th>Order Total</th>
                <td>
                  <input type="hidden" name="grand_total" class="grand_total">
                  <strong><span class="amount grand-total">Rp.0</span></strong> <!-- Grand total will be updated dynamically -->
                </td>
              </tr>
            </tbody>
          </table>

        </div>
      </div> <!-- end col cart totals -->

    </div>
  </div> <!-- end row -->
</section> <!-- end cart -->

@endsection

@push('js')
<script>
  $(document).ready(function() {
    // Function to update the total price based on item quantities and shipping cost
    function updateTotal() {
      var cartTotal = 0;
      $('.cart-item').each(function() {
        var quantity = parseInt($(this).find('.quantity').val());
        var price = parseInt($(this).find('.price').text().replace('Rp.', '').replace(/\./g, '').replace(',', ''));
        cartTotal += quantity * price;
      });
      
      var shippingCost = parseInt($('.shipping-cost').text().replace('Rp.', '').replace(/\./g, '').replace(',', '')) || 0;
      var grandTotal = cartTotal + shippingCost;
      
      $('.cart-total').text('Rp.' + cartTotal.toLocaleString());
      $('.grand-total').text('Rp.' + grandTotal.toLocaleString());
      $('input[name="grand_total"]').val(grandTotal);
    }

    $('#provinsi').change(function() {
      var selectedProvinsi = $(this).val();
      if (selectedProvinsi != "") {
        $.ajax({
          url: '/get_kota/' + selectedProvinsi,
          success: function(data) {
            data = JSON.parse(data);
            var option = "";
            data.rajaongkir.results.map(function(kota) {
              option += "<option value=" + kota.city_id + ">" + kota.city_name + "</option>";
            });
            $('#kota').html(option);
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Failed to retrieve city data. ' + error);
          }
        });
      }
    });

    $('.form-cart').submit(function(e) {
      e.preventDefault(); // Menghentikan pengiriman formulir secara langsung
      
      // Mengisi nilai grand_total jika belum terisi
      var grandTotal = $('input[name="grand_total"]').val();
      if (!grandTotal || grandTotal === "0") {
        updateTotal();
      }

      $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: $(this).serialize(),
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Menambahkan token CSRF di dalam header
        },
        success: function(response) {
          window.location.href = '/checkout';
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          alert('Failed to submit form. ' + error);
        }
      });
    });

    $('.update-total').click(function(e) {
      e.preventDefault();
      var selectedKota = $('#kota').val();
      if (selectedKota != null) {
        $.ajax({
          url: '/get_ongkir/' + selectedKota,
          success: function(data) {
            console.log("Response from server:", data);
            if (data.rajaongkir && data.rajaongkir.results && data.rajaongkir.results.length > 0) {
              var result = data.rajaongkir.results[0];
              if (result.costs && result.costs.length > 0) {
                var shippingCost = parseInt(result.costs[0].cost[0].value);
                $('.shipping-cost').text('Rp.' + shippingCost.toLocaleString());

                // Mengupdate total pesanan
                updateTotal();
              } else {
                alert('Failed to retrieve shipping cost. No shipping options available.');
              }
            } else {
              alert('Failed to retrieve shipping cost. Invalid response data.');
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Failed to retrieve shipping cost. ' + error);
          }
        });
      } else {
        alert('Please select a city.');
      }
    });

    // Update total when quantity changes
    $(document).on('change', '.quantity', function() {
      updateTotal();
    });
  });
</script>



@endpush
