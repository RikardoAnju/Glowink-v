@extends('layout.home')

@section('title', 'Cart')

@section('content')
 <!-- Cart -->
 <section class="section-wrap shopping-cart">
  <div class="container relative">
    <div class="row">

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
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="row mb-50">
          <div class="col-md-7 offset-md-5">
            <div class="actions">
              <input type="submit" name="update_cart" value="Update Cart" class="btn btn-lg btn-stroke">
              <div class="wc-proceed-to-checkout">
                <a href="/checkout" class="btn btn-lg btn-dark"><span>Proceed to Checkout</span></a>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
      <div class="col-md-6 shipping-calculator-form">
        <h2 class="heading relative uppercase bottom-line full-grey mb-30">Calculate Shipping</h2>
        <p class="form-row form-row-wide">
          <select name="provinsi" id="provinsi" class="country_to_state provinsi" rel="calc_shipping_state">
            <option value="">Pilih Provinsi</option>
            @foreach ($provinsi->rajaongkir->results as $prov)
                <option value="{{ $prov->province_id }}">{{ $prov->province }}</option>
            @endforeach
          </select>
        </p>
        <p class="form-row form-row-wide">
          <select name="kota" id="kota" class="country_to_state provinsi kota" rel="calc_shipping_state">
            
          </select>
        </p>
        <div class="row row-10">
          <div class="col-sm-12">
            <p class="form-row form-row-wide">
              <input type="text" class="input-text" placeholder="Detail Alamat" name="detail_alamat" id="detail_alamat">
            </p>
          </div>
        </div>
        <div class="row row-10">
          <div class="col-sm-12">
            <p class="form-row form-row-wide">
              <input type="text" class="input-text" placeholder="Berat" name="berat" id="berat">
            </p>
          </div>
        </div>

        <p>
          <input type="submit" name="calc_shipping" value="Update Totals" class="btn btn-lg btn-stroke mt-10 mb-mdm-40 update-total">
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
                  <strong><span class="amount grand-total">Rp.0</span></strong> <!-- Grand total will be updated dynamically -->
                </td>
              </tr>
            </tbody>
          </table>

        </div>
      </div> <!-- end col cart totals -->

    </div> <!-- end row -->     

    
  </div> <!-- end container -->
</section> <!-- end cart -->

@endsection

@push('js')
<script>
 $(document).ready(function() {
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

    $('.update-total').click(function() {
        var selectedKota = $('#kota').val();
        var berat = $('#berat').val();
        if (selectedKota != null && berat != "") {
            $.ajax({
                url: '/get_ongkir/' + selectedKota + '/' + berat,
                success: function(data) {
                    console.log("Response from server:", data);
                    if (data.rajaongkir && data.rajaongkir.results && data.rajaongkir.results.length > 0) {
                        var result = data.rajaongkir.results[0];
                        if (result.costs && result.costs.length > 0) {
                            var shippingCost = parseInt(result.costs[0].cost[0].value);
                            $('.shipping-cost').text('Rp.' + shippingCost);

                            // Update total pesanan
                            var cartTotal = parseInt($('.cart-total').text().replace('Rp.', '').replace('.', '').replace(',', ''));
                            var grandTotal = cartTotal + shippingCost;
                            $('.grand-total').text('Rp.' + grandTotal);
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
            alert('Please select a city and enter the weight.');
        }
    });

    // Function to format number
    function number_format(number, decimals, dec_point, thousands_sep) {
        // Implementasi fungsi number_format di sini
    }
});

</script>
@endpush
