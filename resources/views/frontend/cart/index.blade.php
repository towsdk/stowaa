@extends('layouts.frontend')

@section('title',"Cart")

@section('content')
<!-- breadcrumb_section - start
    ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index-2.html">Home</a></li>
                <li>Cart</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
    ================================================== -->

    <!-- cart_section - start  
    ================================================== -->
    <section class="cart_section section_space">
        <div class="container">
            <div class="cart_update_wrap">
                <p class="mb-0"><i class="fal fa-check-square"></i> Shipping costs updated.</p>
            </div>

            <div class="cart_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Color & Size</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                       
                        <tr class="parent_row">
                            <td>
                                <div class="cart_product">
                                    <img src="{{ asset('storage/product/'.$cart->inventory->product->image) }}" alt="image_not_found">
                                    <h3><a href="shop_details.html"> {{ $cart->inventory->product->title }}</a></h3>
                                </div>
                            </td>
                            <td class="text-center">$
                                <span class="price_text base_price">
                              @if ($cart->inventory->product->sale_price)
                                  {{ $cart->inventory->product->sale_price + $cart->inventory->additional_price ?? ''}}
                                  @else
                                  {{ $cart->inventory->product->price + $cart->inventory->additional_price ?? ''}}
                              @endif  
                            </span></td>
                            <td>
                                <span>{{ $cart->inventory->size->name }}</span>
                                - 
                                <span>{{ $cart->inventory->color->name }}</span>
                            </td>
                            <td class="text-center">
                                <form action="#">
                                    <div class="quantity_input">
                                        <input type="hidden" class="stock" value="{{ $cart->inventory->quantity }}">
                                        <input type="hidden" class="inventory_id" value="{{ $cart->inventory->id }}">
                                        <input type="hidden" class="stock" value="{{ $cart->inventory->quantity }}">
                                        <button type="button" class="input_number_decrement">
                                            <i class="fal fa-minus"></i>
                                        </button>
                                        <input class="input_number" type="text" value="{{ $cart->cart_quantity }}" />
                                        <button type="button" class="input_number_increment">
                                            <i class="fal fa-plus"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <span >{{ $cart->inventory->quantity }}</span>
                            </td>
                            <td class="text-center">$
                                <span class="price_text price_total">
                                    {{ (($cart->inventory->product->sale_price ?? $cart->inventory->product->price) + $cart->inventory->additional_price ?? '') * $cart->cart_quantity }}</span></td>
                            <td class="text-center">
                                <form action="{{ route('frontend.cart.delete', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>  
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

            <div class="cart_btns_wrap">
                <div class="row">
                    <div class="col col-lg-6">
                        <form action="#">
                            <div class="coupon_form form_item mb-0">
                                <input type="text" name="coupon" placeholder="Coupon Code...">
                                <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                <div class="info_icon">
                                    <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col col-lg-6">
                        <ul class="btns_group ul_li_right">
                            <li><a class="btn border_black" href="#!">Update Cart</a></li>
                            <li><a class="btn btn_dark" href="#!">Prceed To Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-lg-6">
                    <div class="calculate_shipping">
                        <h3 class="wrap_title">Calculate Shipping <span class="icon"><i class="far fa-arrow-up"></i></span></h3>
                        <form action="#">
                            <div class="select_option clearfix">
                                <select>
                                    <option data-display="Select Your Currency">Select Your Option</option>
                                    <option value="1" selected>United Kingdom (UK)</option>
                                    <option value="2">United Kingdom (UK)</option>
                                    <option value="3">United Kingdom (UK)</option>
                                    <option value="4">United Kingdom (UK)</option>
                                    <option value="5">United Kingdom (UK)</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="form_item">
                                        <input type="text" name="location" placeholder="State / Country">
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form_item">
                                        <input type="text" name="postalcode" placeholder="Postcode / ZIP">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn_primary rounded-pill">Update Total</button>
                        </form>
                    </div>
                </div>

                <div class="col col-lg-6">
                    <div class="cart_total_table">
                        <h3 class="wrap_title">Cart Totals</h3>
                        <ul class="ul_li_block">
                            <li>
                                <span>Cart Subtotal</span>
                                <span>$52.50</span>
                            </li>
                            <li>
                                <span>Shipping and Handling</span>
                                <span>Free Shipping</span>
                            </li>
                            <li>
                                <span>Order Total</span>
                                <span class="total_price">$52.50</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('script')
   <script>
    $(function(){
        var input_number = $('.input_number');

        $('.input_number_increment').on('click', function(){
            var parent_row = $(this).parents('.parent_row');
            var base_price = parent_row.children('td').find('.base_price').html();
            var price_total = parent_row.children('td').find('.price_total');

            var child = $(this).parent('.quantity_input').children('.input_number');
            var inc = child.val();

            var stock = $(this).parent('.quantity_input').children('.stock').val();
            if(inc < parseInt(stock)){
                inc++;
            }
            child.val(inc);

            var inventory_id = $(this).parent('.quantity_input').children('.inventory_id').val();

            $.ajax({
                    url:" {{ route('frontend.cart.update') }}",
                    type: 'POST',
                    data: {
                        inventory_id : inventory_id,
                        quantity: inc,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json', 
                    success: function (data) {
                        price_total.html(parseInt(base_price)*inc);
                        
                    }
                  });
        })
        
        $('.input_number_decrement').on('click',function(){
            var parent_row = $(this).parents('.parent_row');
            var base_price = parent_row.children('td').find('.base_price').html();
            var price_total = parent_row.children('td').find('.price_total');

            var child = $(this).parent('.quantity_input').children('.input_number');
            var inc = child.val();
            if(inc > 1){
                inc--;
            }
            child.val(inc);

            var inventory_id = $(this).parent('.quantity_input').children('.inventory_id').val();

            $.ajax({
                    url:" {{ route('frontend.cart.update') }}",
                    type: 'POST',
                    data: {
                        inventory_id : inventory_id,
                        quantity: inc,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json', 
                    success: function (data) {
                         price_total.html(parseInt(base_price)*inc);
                        
                    }
                  }); 

        })
    })
   </script>
@endsection