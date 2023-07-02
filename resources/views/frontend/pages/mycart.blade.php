@extends('frontend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="your-order">
                <h3>Your Cart</h3>
                <div class="">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="li-product-thumbnail">Product</th>
                                <th class="cart-product-name">Quantity</th>
                                <th class="li-product-price">Unit Price</th>
                                <th class="li-product-price">Sub Total</th>
                                <th class="li-product-add-cart">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @foreach ($carts as $item)
                                <tr>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td data-id="{{ $item->id }}" data-product_id="{{ $item->product_id }}"
                                        class="d-flex">
                                        <button class="btn btn-danger m-2 btn-sm decrease-qty">-</button>
                                        <div class="quantity" data-qty="{{ $item->quantity }}">  {{ $item->quantity }}  </div>
                                        <button class="btn btn-success btn-sm m-2 increase-qty">+</button>
                                    </td>
                                    <td class="rate">
                                       $ {{ $item->price }}
                                    </td>
                                    <td class="sub-total">
                                        {{ $item->price * $item->quantity }}
                                    </td>
                                    <td data-id="{{ $item->id }}">
                                        <div class="remove-cart btn btn-danger"> Remove</div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-12">

            <div class="checkbox-form">
                {{-- <h3>Have Coupon ?</h3> --}}
                <div class="row">
                    {{-- <div class="col-md-12">
                    @if (Session::has('coupon'))
                    @else
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="account-fn">{{ __('Coupon Code') }}</label>
                                <input class="form-control" name="coupon_code" type="text" id="coupon_code" value="">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-right">
                                <button class="btn btn-primary margin-bottom-none" type="submit" onclick="applyCoupon()">{{ __('Apply Coupon') }}</button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div> --}}
                    <div class="col-md-12 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <table class="table table-responsive">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Total :
                                                </th>
                                                <td>
                                                    $ {{$carts->sum('sub_total')}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <a href="{{route('create_sales_order')}}" class="btn btn-primary btn-main w-100 text-white"> Make Purchase </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.increase-qty').on('click', increase_qty);
            $('.decrease-qty').on('click', decrease_qty);
            $('.remove-cart').on('click', delete_to_cart);

            function increase_qty() {
                var row = $(this).closest('tr');
                var item = $(this).closest('td');
                var space = $(this).closest('td').find('.quantity');
                var cart_id = item.data('id');
                var product_id = item.data('product_id');
                var qty = parseInt( space.data('qty'));
                console.log(qty);
                var url1 = "{{ route('addtocart_direct', ['idl1']) }}";
                url1 = url1.replace('idl1', product_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: {
                        cart_id: cart_id,
                    },
                    url: url1,
                    success: function(result) {
                        space.html(result.qty);
                        space.data('qty', result.qty);
                        var rate = row.find('.rate').text();
                        row.find('.sub-total').html(rate * result.qty)
                    }
                });
            }

            function decrease_qty() {
                var row = $(this).closest('tr');
                var item = $(this).closest('td');
                var space = $(this).closest('td').find('.quantity');
                var cart_id = item.data('id');
                var product_id = item.data('product_id');
                var qty = space.data('qty');
                var url1 = "{{ route('subtocart_direct', ['idl1']) }}";
                url1 = url1.replace('idl1', product_id);
                console.log(typeof qty);
                if (qty > 1) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        data: {
                            cart_id: cart_id,
                        },
                        url: url1,
                        success: function(result) {
                            space.html(result.qty);
                            space.data('qty', result.qty);
                            var rate = row.find('.rate').text();
                            row.find('.sub-total').html(rate * result.qty)
                        }
                    });
                } else {
                    alert('Atleast One Item is necesary')
                }

            }
            function delete_to_cart() {
                var row = $(this).closest('tr');
                var item = $(this).closest('td');
           
                var cart_id = item.data('id');
                var url1 = "{{ route('delete_to_cart') }}";
         
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        data: {
                            cart_id: cart_id,
                        },
                        url: url1,
                        success: function(result) {
                           alert(result.message)
                           row.remove();
                        }
                    });
             

            }
        })
    </script>
@endsection
