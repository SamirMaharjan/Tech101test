@extends('frontend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="your-order">
                <h3>Your order</h3>
                <div class="your-order-table table-responsive">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="li-product-thumbnail">id</th>
                                <th class="cart-product-name">User</th>
                                <th class="li-product-price">Amount</th>
                                <th class="li-product-price">Status</th>
                                <th class="li-product-price">Date</th>
                                <th class="li-product-add-cart">Action</th>
                            </tr>
                        </thead>
                        <tbody id="cart_all_products">
                            @foreach ($sales_orders as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td data-id="{{ $item->id }}">
                                    
                                       {{ $item->user->name }} 
                                    
                                    </td>
                                    <td class="rate">
                                        $ {{ $item->amount }}
                                    </td>
                                    <td class="sub-total">
                                        {{ $item->status }}
                                    </td>
                                    <td >
                                        {{ $item->created_at }}
                                    </td>
                                    <td data-id="{{ $item->id }}">
                                        <a href="{{route('complete_sales_order',$item->id)}}"><div class="complete_order btn btn-success"> Complete</div></a> 
                                        <a href="{{route('cancel_sales_order',$item->id)}}"><div class="cancel_order btn btn-danger btn-sm"> Cancel</div></a> 
                                        
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                @if (count($completed_orders)>0)
                <div class="bg-info">
                    <table class="table table-responsive">
                        <h2>Completed Orders</h2>
                        <thead>
                            <tr>
                                <th class="li-product-thumbnail">id</th>
                                <th class="cart-product-name">User</th>
                                <th class="li-product-price">Amount</th>
                                <th class="li-product-price">Status</th>
                                <th class="li-product-price">Date</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @foreach ($completed_orders as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td data-id="{{ $item->id }}">
                                    
                                       {{ $item->user->name }} 
                                    
                                    </td>
                                    <td class="rate">
                                        $ {{ $item->amount }}
                                    </td>
                                    <td class="sub-total">
                                        {{ $item->status }}
                                    </td>
                                    <td >
                                        {{ $item->updated_at }}
                                    </td>
                                    
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                @endif
                
                @if (count($cancelled_orders)>0)
                <div class="your-order-table table-responsive">
                    <table class="table table-responsive">
                        <h2>Canceled Orders</h2>
                        <thead>
                            <tr>
                                <th class="li-product-thumbnail">id</th>
                                <th class="cart-product-name">User</th>
                                <th class="li-product-price">Amount</th>
                                <th class="li-product-price">Status</th>
                                <th class="li-product-price">Date</th>
                              
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($cancelled_orders as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td data-id="{{ $item->id }}">
                                    
                                       {{ $item->user->name }} 
                                    
                                    </td>
                                    <td class="rate">
                                        $ {{ $item->amount }}
                                    </td>
                                    <td class="sub-total">
                                        {{ $item->status }}
                                    </td>
                                    <td >
                                        {{ $item->updated_at }}
                                    </td>
                                    
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                @endif
               

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
                                                <th>You can earn Rewards Upto</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Total :
                                                </th>
                                                <td>
                                                    {{$sales_orders->sum('amount')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="text-warning text-small">Note: 100 reward Point is Equivalent to $1</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <a href="#" class="btn btn-success btn-main w-100 text-white"> Complete Your Purchase Now </a>
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
                           window.location.replace('{{route("index")}}');
                        }
                    });
             

            }
        })
    </script>
@endsection
