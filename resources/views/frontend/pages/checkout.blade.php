@extends('frontend.layouts.master')
@section('title')
    {{ $settings->site_name }} || Checkout
@endsection
@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>check out</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">check out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <h5 class="d-flex justify-content-between align-items-center">Shipping Details <a
                                class="btn btn-outline-primary " href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">add
                                new address</a></h5>
                        <div class="row">
                            @foreach ($user_address as $address)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" data-id="{{ $address->id }}"
                                                type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span> {{ $address->name }}</li>
                                            <li><span>Phone :</span>{{ $address->phone }}</li>
                                            <li><span>Email :</span>{{ $address->email }} </li>
                                            <li><span>Country :</span> {{ $address->country }}</li>
                                            <li><span>State :</span> {{ $address->state }}</li>
                                            <li><span>City :</span> {{ $address->city }}</li>
                                            <li><span>Zip Code :</span> {{ $address->zip }}</li>
                                            <li><span>Address :</span> {{ $address->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">shipping Methods</p>
                        @foreach ($shipping_roule as $shiping)
                            @if ($shiping->type === 'min_cost' && getCartTotal() >= $shiping->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $shiping->id }}" data-id="{{ $shiping->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $shiping->name }}
                                        <span>({{ $settings->currency_icon }}{{ $shiping->cost }})</span>
                                    </label>
                                </div>
                            @elseif($shiping->type === 'flat_cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios2" value="{{ $shiping->id }}" data-id="{{ $shiping->cost }}">
                                    <label class="form-check-label" for="exampleRadios2">
                                        {{ $shiping->name }}
                                        <span>({{ $settings->currency_icon }}{{ $shiping->cost }})</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                        <div class="wsus__order_details_summery">
                            <p>subtotal: <span><b>{{ $settings->currency_icon }}{{ getCartTotal() }}</b></span></p>
                            <p>shipping fee(+): <span><b id="shipping_fee">{{ $settings->currency_icon }}0</b></span>
                            </p>
                            <p>coupon(-): <span><b>{{ $settings->currency_icon }}{{ getCartDiscount() }}</b></span>
                            </p>
                            <p><b>total:</b>
                                <span><b id="total_pay_ammount"
                                        data-id="{{ getMainCartTotal() }}">{{ $settings->currency_icon }}{{ getMainCartTotal() }}</b></span>
                            </p>
                        </div>
                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input agree_trem" type="checkbox" value=""
                                    id="flexCheckChecked3" checked>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    I have read and agree to the website <a href="#">terms and conditions *</a>
                                </label>
                            </div>
                        </div>
                        <form action="" id="checkoutForm">
                            <input type="hidden" name="shipping_method_id" value="" id="shipping_method_id">
                            <input type="hidden" name="shipping_address_id" value="" id="shipping_address_id">
                        </form>
                        <a href="payment.html" id="submitCheckOut" class="common_btn">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{ route('user.checkout.address-create') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Name *" name="name"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Phone *" name="phone"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" placeholder="Email *" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <select class="form-control select_2" name="country">
                                                <option value="">Country *</option>
                                                @foreach (config('setting.country_list') as $key => $country)
                                                    <option {{ $country === old('country') ? 'select' : '' }}
                                                        value="{{ $country }}">{{ $country }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="State *" name="state"
                                                value="{{ old('state') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Town / City *" name="city"
                                                value="{{ old('city') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Zip *" name="zip"
                                                value="{{ old('zip') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Address *" name="address"
                                                value="{{ old('address') }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // select shipping fee and totalPAyment Amount With Shipping Charge
        $('.shipping_method').on('click', function() {
            // alert($(this).val());
            let shipingFree = $(this).data('id');
            // alert(shipingFree);
            let currentTotalAmount = $('#total_pay_ammount').data('id');
            let totalAmountWithShipings = currentTotalAmount + shipingFree;
            $('#shipping_method_id').val($(this).val());
            $('#shipping_fee').text("{{ $settings->currency_icon }}" + shipingFree);
            $('#total_pay_ammount').text("{{ $settings->currency_icon }}" + totalAmountWithShipings);
        })

        // Select shipping Address  
        $('.shipping_address').on('click', function() {
            // alert($(this).data('id'));
            $('#shipping_address_id').val($(this).data('id'));

        })
        $('#submitCheckOut').on('click', function(e) {
            e.preventDefault();
            // alert('Please enter');
            if ($('#shipping_method_id').val() == "" && $('#shipping_address_id').val() == "" && !$('.agree_trem')
                .prop('checked')) {
                toastr.error('Please select shipping method');
                toastr.error('Please select shipping address');
                toastr.error('You Have to agree website trem and condition');
            } else if ($('#shipping_address_id').val() == "") {
                toastr.error('Please select shipping address');
            } else if ($('#shipping_method_id').val() == "") {
                toastr.error('Please select shipping method');
            } else if (!$('.agree_trem').prop('checked')) {
                toastr.error('You Have to agree website trem and condition');
            } else {
                $.ajax({
                    url: "{{ route('user.checkout.place-order') }}",
                    method: 'POST',
                    data: $('#checkoutForm').serialize(),
                    beforeSend: function() {
                        $('#submitCheckOut').html('<i class="fas fa-spinner fa-spin fa-1x"></i>');
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#submitCheckOut').html('Place Order');
                            // After Page Redirect Payment Page
                            window.location.href = data.redirect_url;
                        } else {
                            // toastr.error(data.message);
                        }
                    }
                })
            }

        })
    </script>
@endpush
