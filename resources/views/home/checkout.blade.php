@extends('layout.home')
@section('title', 'Checkout')
@section('content')
<!-- Checkout -->
<section class="section-wrap checkout pb-70">
  <div class="container relative">
    <div class="row">

      <div class="ecommerce col-xs-12">

        <form name="checkout" class="checkout ecommerce-checkout row">

          <div class="col-md-8" id="customer_details">
            <div>
              <h2 class="heading uppercase bottom-line full-grey mb-30">billing address</h2>
              <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field" id="billing_first_name_field">
                <label for="billing_first_name">First Name
                  <abbr class="required" title="required">*</abbr>
                </label>
                <input type="text" class="input-text" placeholder value name="billing_first_name" id="billing_first_name">
              </p>
              <div class="clear"></div>

            </div>

            <div class="clear"></div>

            <div class="clear"></div>

          </div> <!-- end col -->

          <!-- Your Order -->
          <div class="col-md-4">
            <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
              <h2 class="heading uppercase bottom-line full-grey">Your Order</h2>
              <table class="table shop_table ecommerce-checkout-review-order-table">
                <tbody>
                    <th><strong>Order Total</strong></th>
                    <td>
                      <strong><span class="amount">$1799.00</span></strong>
                    </td>
                  </tr>
                </tbody>
              </table>

              <div id="payment" class="ecommerce-checkout-payment">
                <h2 class="heading uppercase bottom-line full-grey">Payment Method</h2>
                <ul class="payment_methods methods">

                  <li class="payment_method_bacs">
                    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked">
                    <label for="payment_method_bacs">Direct Bank Transfer</label>
                    <div class="payment_box payment_method_bacs">
                      <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order wont be shipped until the funds have cleared in our account.</p>
                    </div>
                  </li>
                </ul>
                <div class="form-row place-order">
                  <input type="submit" name="ecommerce_checkout_place_order" class="btn btn-lg btn-dark" id="place_order" value="Place order">
                </div>
              </div>
            </div>
          </div> <!-- end order review -->
        </form>

      </div> <!-- end ecommerce -->

    </div> <!-- end row -->
  </div> <!-- end container -->
</section> <!-- end checkout -->

@endsection


