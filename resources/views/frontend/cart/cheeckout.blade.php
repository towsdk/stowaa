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

                        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="#">
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
                                                id="billing_phone" placeholder="" autocomplete="tel" value="" />
                                        </p>
                                        <div class="clear"></div>
                                       
                                        <p class="form-row form-row form-row-wide address-field validate-required"
                                            id="billing_address_1_field">
                                            <label for="billing_address_1" class="">Address <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="billing_address_1"
                                                id="billing_address_1" placeholder="Street address"
                                                autocomplete="address-line1" value="" />
                                        </p>
                                        <p class="form-row form-row address-field validate-postcode validate-required form-row-first  woocommerce-invalid-required-field"
                                            id="billing_city_field">
                                            <label for="billing_city" class="">Town / City <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="billing_city"
                                                id="billing_city" placeholder="" autocomplete="address-level2"
                                                value="" />
                                        </p>
                                        <p class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                            id="billing_postcode_field">
                                            <label for="billing_postcode" class="">Postcode / ZIP <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="billing_postcode8"
                                                id="billing_postcode" placeholder="" autocomplete="postal-code"
                                                value="" />
                                        </p>
                                        <div class="clear"></div>
                                        <p class="form-row form-row notes" id="order_comments_field">
                                            <label for="order_comments" class="">Order Notes</label>
                                            <textarea name="order_comments" class="input-text " id="order_comments"
                                                placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                        </p>
                                    </div>
                                </div>
                                <div class="coll-2">
                                    <div class="woocommerce-shipping-fields">
                                        <h3 id="ship-to-different-address">
                                            <label for="ship-to-different-address-checkbox" class="checkbox">Ship to a
                                                different address?</label>
                                            <input id="ship-to-different-address-checkbox" class="input-checkbox"
                                                type="checkbox" name="ship_to_different_address" value="1" />
                                        </h3>
                                        <div class="shipping_address">
                                            <div class="clear"></div>
                                            <p class="form-row form-row form-row-wide" id="shipping_company_field">
                                                <label for="shipping_company" class=""> Name</label>
                                                <input type="text" class="input-text " name="shipping_name"
                                                    id="shipping_company" placeholder=""
                                                    value="" />
                                            </p>
                                            <p class="form-row form-row form-row-wide validate-required validate-phone"
                                            id="billing_phone_field">
                                            <label for="billing_phone" class="">Phone <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="tel" class="input-text " name="billing_phone"
                                                 placeholder=""  value="" />
                                        </p>
                                            <p class="form-row form-row form-row-wide address-field validate-required"
                                                id="shipping_address_1_field">
                                                <label for="shipping_address_1" class="">Address <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="shipping_address_1"
                                                    id="shipping_address_1" placeholder="Street address"
                                                    autocomplete="address-line1" value="" />
                                            </p>
                                            <p class="form-row form-row address-field validate-postcode validate-required form-row-first  woocommerce-invalid-required-field"
                                                id="billing_city_field2">
                                                <label for="billing_city" class="">Town / City <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="billing_city"
                                                    id="billing_city3" placeholder="" autocomplete="address-level2"
                                                    value="" />
                                            </p>
                                            <p class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                                id="billing_postcode_field17">
                                                <label for="billing_postcode" class="">Postcode / ZIP <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="billing_postcode"
                                                    id="billing_postcode4" placeholder="" autocomplete="postal-code"
                                                    value="" />
                                            </p>
                                            <div class="clear"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
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
                                                {{ $cart->inventory->product->tit }} <strong class="product-quantity">
                                                    {{ $cart->cart_quantity }}</strong>
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
                                              @if (Session::get('shipping_charge') && Session::get('coupon'))
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
                                        <li class="wc_payment_method payment_method_paypal">
                                            <input id="payment_method_paypal" type="radio" class="input-radio"
                                                name="payment_method" value="paypal"
                                                data-order_button_text="Proceed to PayPal" />
                                            <!--grop add span for radio button style-->
                                            <span class='grop-woo-radio-style'></span>
                                            <!--custom change-->
                                            <label for="payment_method_paypal">
                                                PayPal <img src="assets/images/paypal.png"
                                                    alt="PayPal Acceptance Mark" /><a href="#" class="about_paypal"
                                                    title="What is PayPal?">What is PayPal?</a> </label>
                                            <div class="payment_box payment_method_paypal" style="display:none;">
                                                <p>Pay via PayPal; you can pay with your credit card if you don&#8217;t have
                                                    a PayPal account.</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="form-row place-order">
                                        <noscript>
                                            Since your browser does not support JavaScript, or it is disabled, please ensure
                                            you click the <em>Update Totals</em> button before placing your order. You may
                                            be charged more than the amount stated above if you fail to do so.
                                            <br />
                                            <input type="submit" class="button alt"
                                                name="woocommerce_checkout_update_totals" value="Update totals" />
                                        </noscript>
                                        <input type="submit" class="button alt" name="woocommerce_checkout_place_order"
                                            id="place_order" value="Place order" data-value="Place order" />
                                        <input type="hidden" id="_wpnonce5" name="_wpnonce" value="783c1934b0" />
                                        <input type="hidden" name="_wp_http_referer" value="/wp/?page_id=6" />
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