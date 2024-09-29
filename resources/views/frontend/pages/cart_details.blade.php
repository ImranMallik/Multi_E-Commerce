@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Cart Details
@endsection
@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Unit price
                                        </th>
                                        <th class="wsus__pro_tk">
                                            Total
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>



                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ $item->options->image }}" alt="product"
                                                    class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{{ limitText($item->name, 15) }}</p>
                                                @foreach ($item->options->variants as $key => $value)
                                                    <span>{{ $key }}:
                                                        {{ $value['name'] }}
                                                        ({{ $settings->currency_icon . $value['price'] }})
                                                    </span>
                                                @endforeach
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>{{ $settings->currency_icon . $item->price }}</h6>
                                            </td>
                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $item->rowId }}">
                                                    {{ $settings->currency_icon . ($item->price + $item->options->variants_total) * $item->qty }}
                                                </h6>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <div class="product_qty_wrapper">
                                                    <button class="btn btn-danger mx-2 product-decrement">-</button>
                                                    <input class="product-qty" data-rawid={{ $item->rowId }} readonly
                                                        type="text" min="1" max="100"
                                                        value="{{ $item->qty }}" />
                                                    <button class="btn btn-success mx-2 product-increment">+</button>
                                                </div>
                                            </td>



                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('cart.clearPerItem', $item->rowId) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($cartItems) === 0)
                                        <tr class="d-flex">
                                            <td class="wsus_pro_icon" rowspan="2" style="width:100%">
                                                Cart is Empty!📪
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="sub_total">{{ $settings->currency_icon }}{{ getCartTotal() }}</span></p>
                        {{-- <p>delivery: <span>{{ $settings->currency_icon }}</span></p> --}}
                        <p>coupon(-): <span id="discount">{{ $settings->currency_icon }}{{ getCartDiscount() }}</span>
                        </p>
                        <p class="total"><span>total:</span> <span
                                id="cart_total">{{ $settings->currency_icon }}{{ getMainCartTotal() }}</span>
                        </p>

                        <form id="coupon_form">
                            <input type="text" placeholder="Coupon Code" name="coupon"
                                value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{ route('user.checkout.index') }}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{ route('home') }}"><i
                                class="fab fa-shopify"></i> keep Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset('frontend/assets/images/single_banner_2.jpg') }}" alt="banner"
                                class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset('frontend/assets/images/single_banner_3.jpg') }}" alt="banner"
                                class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Increment Ajax counter
            $('.product-increment').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rawid');
                input.val(quantity);
                $.ajax({
                    url: "{{ route('cart.updateQuantity') }}",
                    method: 'POST',
                    data: {
                        quantity: quantity,
                        rowId: rowId
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .productTotal;
                            $(productId).text(totalAmount);
                            renderCartSubtotal();
                            calculateCouponDiscountAmount();

                            toastr.success(data.message);
                        } else if (data.status === 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(error) {
                        // console.log(error);
                    }
                })
            });

            // Decrement Ajax counter
            $('.product-decrement').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rawid');
                if (quantity > 0) {
                    input.val(quantity);
                    $.ajax({
                        url: "{{ route('cart.updateQuantity') }}",
                        method: 'POST',
                        data: {
                            quantity: quantity,
                            rowId: rowId
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                let productId = '#' + rowId;
                                let totalAmount = "{{ $settings->currency_icon }}" + data
                                    .productTotal;
                                $(productId).text(totalAmount);
                                renderCartSubtotal();
                                calculateCouponDiscountAmount();
                                toastr.success(data.message);
                            } else if (data.status === 'error') {
                                toastr.error(data.message);
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    })
                }
            });

            // clear Cart All Items 
            $('.clear_cart').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action will clear all cart items!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, clear it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'get',
                            url: "{{ route('cart.clearAllCartItem') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function(data) {
                                if (data.status === 'success') {
                                    toastr.success(data.message);
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 3000);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }

                        });

                    }
                });
            })

            // Ptice increment or decrement in cart details page
            function renderCartSubtotal() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('total-cart-sidebar-products') }}",
                    success: function(data) {
                        // return data;
                        console.log(data);
                        $('#sub_total').text("{{ $settings->currency_icon }}" + data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            // Apply Coupon

            $('#coupon_form').on('submit', function(e) {
                e.preventDefault();
                let couponCode = $(this).find('input[name="coupon"]').val();
                // alert(couponCode);
                $.ajax({
                    url: "{{ route('apply-coupon') }}",
                    method: 'GET',
                    data: {
                        couponCode: couponCode
                    },
                    success: function(data) {
                        if (data.status === 'error') {
                            toastr.error(data.message);
                        } else if (data.status === 'success') {
                            calculateCouponDiscountAmount();
                            toastr.success(data.message);

                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            //Calculate Coupon Discount Amount
            function calculateCouponDiscountAmount() {
                $.ajax({
                    url: "{{ route('calculate-coupon-discount') }}",
                    method: 'GET',
                    success: function(data) {
                        // console.log(data);
                        if (data.status === 'success') {
                            $('#discount').text('{{ $settings->currency_icon }}' + data.discount);
                            $('#cart_total').text('{{ $settings->currency_icon }}' + data.cart_total);

                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            }

        });
    </script>
@endpush
