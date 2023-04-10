@extends('layouts.frontend')

@section('title', 'Cheeckout')

@section('content')

    <!-- checkout-section - start
    ================================================== -->
    <section class="checkout-section section_space">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="woocommerce">

                        <div class="woocommerce-info">Have a coupon? <a href="#" class="showcoupon">Click here to enter
                                your code</a></div>

                        <form method="POST" class="checkout woocommerce-checkout needs-validation" action="{{ url('/pay') }}">
                            @csrf
                            <div class="col2-set" id="customer_details">
                                <div class="coll-1">
                                    <div class="woocommerce-billing-fields">
                                        <h3>Billing Details</h3>
                                        
                                        <p class="form-row form-row form-row-wide validate-required"
                                            id="billing_first_name_field">
                                            <label for="billing_first_name" class="">Name <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="billing_name"
                                                id="billing_first_name" placeholder="" autocomplete="given-name"
                                                value="{{ auth()->user()->name }}" />
                                        </p>
                                        <p class="form-row form-row form-row-first validate-required validate-email"
                                            id="billing_email_field">
                                            <label for="billing_email" class="">Email Address <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="email" class="input-text " name="billing_email"
                                                id="billing_email" placeholder="" autocomplete="email" value="{{ auth()->user()->email }}" />
                                        </p>
                                        <p class="form-row form-row form-row-last validate-required validate-phone"
                                            id="billing_phone_field">
                                            <label for="billing_phone" class="">Phone <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="tel" class="input-text " name="billing_phone"
                                                id="billing_phone" placeholder="" autocomplete="tel" value="{{ auth()->user()->user_info->phone ?? ''}}" />
                                        </p>
                                        <div class="clear"></div>
                                       
                                        <p class="form-row form-row form-row-wide address-field validate-required"
                                            id="billing_address_1_field">
                                            <label for="billing_address_1" class="">Address <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="billing_address_1"
                                                id="billing_address_1" placeholder="Street address"
                                                autocomplete="address-line1" value="{{ auth()->user()->user_info->address ?? ''}}" />
                                        </p>
                                        <p class="form-row form-row address-field validate-postcode validate-required form-row-first  woocommerce-invalid-required-field"
                                            id="billing_city_field">
                                            <label for="billing_city" class="">Town / City <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="billing_city"
                                                id="billing_city" placeholder="" autocomplete="address-level2"
                                                value="{{ auth()->user()->user_info->city ?? ''}}" />
                                        </p>
                                        <p class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                            id="billing_postcode_field">
                                            <label for="billing_postcode" class="">Postcode / ZIP <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="billing_postcode"
                                                id="billing_postcode" placeholder="" autocomplete="postal-code"
                                                value="{{ auth()->user()->user_info->zip ?? ''}}" />
                                        </p>
                                        <div class="clear"></div>
                                        <p class="form-row form-row notes" id="order_comments_field">
                                            <label for="order_comments" class="">Order Notes</label>
                                            <textarea name="billing_notes" class="input-text " id="order_comments"
                                                placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5">{{ auth()->user()->user_info->notes ?? ''}}</textarea>
                                        </p>
                                    </div>
                                </div>
                                <div class="coll-2">
                                    <div class="woocommerce-shipping-fields">
                                        <h3 id="ship-to-different-address">
                                            <label class="checkbox" data-bs-toggle="collapse" data-bs-target="#display_shipping_address">Ship
                                              to a different
                                              address?
                                              <input id="ship-to-different-address-checkbox" class="input-checkbox" type="checkbox"
                                                name="ship_to_different_address" value="1" />
                                            </label>
                                          </h3>
                                          <div class="shipping_address collapse" id="display_shipping_address">

                                            <div class="clear"></div>
                                            <p class="form-row form-row form-row-wide" id="shipping_company_field">
                                                <label for="shipping_company" class=""> Name</label>
                                                <input type="text" class="input-text " name="shipping_name"
                                                    id="shipping_name" placeholder=""
                                                    value="" />
                                            </p>
                                            <p class="form-row form-row form-row-wide validate-required validate-phone"
                                            id="shipping_phone_field">
                                            <label for="shipping_phone2" class="">Phone <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="tel" class="input-text " name="shipping_phone"
                                                 placeholder=""  value="" />
                                        </p>
                                            <p class="form-row form-row form-row-wide address-field validate-required"
                                                id="shipping_address_1_field">
                                                <label for="shipping_address_2" class="">Address <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="shipping_address"
                                                    id="shipping_address_2" placeholder="Street address"
                                                    autocomplete="address-line1" value="" />
                                            </p>
                                            <p class="form-row form-row address-field validate-postcode validate-required form-row-first  woocommerce-invalid-required-field"
                                                id="shipping_city_field">
                                                <label for="shipping_city" class="">Town / City <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="shipping_city"
                                                    id="billing_city3" placeholder="" autocomplete="address-level2"
                                                    value="" />
                                            </p>
                                            <p class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                                id="shipping_postcode_field17">
                                                <label for="shipping_postcode2" class="">Postcode / ZIP <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="shipping_postcode"
                                                    id="shipping_postcode" placeholder="" autocomplete="postal-code"
                                                    value="" />
                                            </p>
                                            <div class="clear"></div>
                                            <p class="form-row form-row notes" id="shipping_notes_field">
                                                <label for="shipping_notes" class="">Order Notes</label>
                                                <textarea name="shipping_notes" class="input-text " id="shipping_notes"
                                                    placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                            </p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            {{-- @foreach ($products as $product)
                                <h2>{{ $product->id }}
                            @endforeach --}}
                            <h3 id="order_review_heading">Your order</h3>
                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <table class="shop_table woocommerce-checkout-review-order-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                {{ $cart->inventory->product->title }} <strong class="product-quantity">
                                                   * {{ $cart->cart_quantity }}</strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="woocommerce-Price-amount amount"><span
                                                        class="woocommerce-Price-currencySymbol">$</span>{{ $cart->sub_total }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="woocommerce-Price-amount amount"><span
                                                        class="woocommerce-Price-currencySymbol">$</span>{{ $cart->sum('sub_total') }}</span>
                                            </td>
                                        </tr>
                                        @if (Session::has('shipping_charge'))
                                        <tr class="shipping">
                                          <th>Shipping Charge</th>
                                          <td data-title="Shipping">
                                            @if (Session::get('shipping_charge') > 0)
                                              +${{ Session::get('shipping_charge') }}
                                            @else
                                              Free Shipping
                                            @endif
                                          </td>
                                        </tr>
                                      @endif
                                      @if (Session::has('coupon'))
                                        <tr class="shipping">
                                          <th>Coupon({{ Session::get('coupon')['couponName'] }})</th>
                                          <td data-title="Shipping">
                                            -${{ Session::get('coupon')['amount'] ? Session::get('coupon')['amount'] : '' }}
                                          </td>
                                        </tr>
                                      @endif
                                      <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="woocommerce-Price-amount amount"><span
                                                class="woocommerce-Price-currencySymbol">$</span>
                                              @if (Session::has('shipping_charge') && Session::has('coupon'))
                                                {{ $cart->sum('sub_total') + Session::get('shipping_charge') - Session::get('coupon')['amount'] }}
                                              @else
                                                {{ $cart->sum('sub_total') + Session::get('shipping_charge') }}
                                              @endif
                                            </span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div id="payment" class="woocommerce-checkout-payment">
                                    <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_cheque">
                                            <input id="payment_method_cheque" type="radio" class="input-radio"
                                                name="payment_method" value="cheque" checked='checked'
                                                data-order_button_text="" />
                                            <!--grop add span for radio button style-->
                                            <span class='grop-woo-radio-style'></span>
                                            <!--custom change-->
                                            <label for="payment_method_cheque">
                                                Check Payments </label>
                                            <div class="payment_box payment_method_cheque">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State
                                                    / County, Store Postcode.</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="form-row place-order">
                                        
                                        <button class="button alt" type="submit">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/woocommerce-2.css') }}">
@endsection

@section('script')
<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
@endsection