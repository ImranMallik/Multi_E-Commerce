@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp
@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>

        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <b>Name:</b> {{ $address->name }}<br>
                                        <b>Email:</b> {{ $address->email }}<br>
                                        <b>Phone:</b> {{ $address->address }}<br>
                                        <b>Address:</b> {{ $address->city }},{{ $address->state }},{{ $address->zip }}<br>
                                        <b>Country:</b> {{ $address->country }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <b>Name:</b> {{ $address->name }}<br>
                                        <b>Email:</b> {{ $address->email }}<br>
                                        <b>Phone:</b> {{ $address->address }}<br>
                                        <b>Address:</b>
                                        {{ $address->city }},{{ $address->state }},{{ $address->zip }}<br>
                                        <b>Country:</b> {{ $address->country }}
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Information:</strong><br>
                                        <b>Method:</b>{{ $order->payment_method }}<br>
                                        <b>Transaction Id:{{ @$order->transaction->transaction_id }}</b><br>
                                        <b>Status:</b>{{ $order->payment_status === 1 ? 'Complete' : 'Pending' }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{ date('d,F,Y', strtotime($order->created_at)) }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th class="text-center">Variant</th>
                                        <th class="text-center">Vendor Name</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Totals</th>
                                    </tr>
                                    @foreach ($order->orderproducts as $orderProduct)
                                        @php
                                            $variants = json_decode($orderProduct->variants);
                                        @endphp
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            @if (isset($orderProduct->product->slug))
                                                <td><a target="_blank"
                                                        href="{{ route('products-details', $orderProduct->product->slug) }}">{{ $orderProduct->product_name }}</a>
                                                </td>
                                            @else
                                                <td>{{ $orderProduct->product_name }}</td>
                                            @endif
                                            <td>
                                                @if ($variants && is_object($variants) && !empty((array) $variants))
                                                    @foreach ($variants as $key => $variant)
                                                        @if ($variant)
                                                            <b>{{ $key }}:</b> {{ $variant->name }}
                                                            ({{ $settings->currency_icon }}{{ $variant->price }})
                                                        @else
                                                            <b>No Variants</b>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <b>No Variants</b>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                {{ @$orderProduct->vendor->shop_name }}
                                            </td>


                                            <td class="text-center">
                                                {{ $settings->currency_icon }}{{ $orderProduct->unit_price }}</td>
                                            <td class="text-center">{{ $orderProduct->quantity }}</td>
                                            <td class="text-right">
                                                {{ $settings->currency_icon }}{{ $orderProduct->unit_price * $orderProduct->quantity + $orderProduct->variant_total }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-6 mt-5">
                                            <div class="form-group">
                                                <label for=""><b>Payment Status</b></label>
                                                <select name="" data-id="{{ $order->id }}" class="form-control"
                                                    id="payment_status">
                                                    <option {{ $order->payment_status === 0 ? 'selected' : '' }}
                                                        value="0">Pending</option>
                                                    <option {{ $order->payment_status === 1 ? 'selected' : '' }}
                                                        value="1">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-5">
                                            <div class="form-group">
                                                <label for=""><b>Order Status</b></label>
                                                <select name="order_status" data-id="{{ $order->id }}"
                                                    class="form-control" id="order_status">
                                                    @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                        <option {{ $order->order_status === $key ? 'selected' : '' }}
                                                            value="{{ $key }}">
                                                            {{ $orderStatus['status'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Subtotal</div>
                                        <div class="invoice-detail-value">
                                            {{ $settings->currency_icon }}{{ $order->subtotal }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Shipping (+)</div>
                                        <div class="invoice-detail-value">
                                            {{ $settings->currency_icon }}{{ $shipping->cost }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Coupon (-)</div>
                                        <div class="invoice-detail-value">
                                            {{ $settings->currency_icon }}
                                            @if ($coupon)
                                                {{ $coupon->discount }}
                                            @else
                                                0
                                            @endif
                                        </div>
                                    </div>

                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{ $settings->currency_icon }}{{ $order->amount }}</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">

                    <button class="btn btn-warning btn-icon icon-left print_invoice"><i class="fas fa-print"></i>
                        Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Order Status Change

            $('#order_status').on('change', function() {
                // alert('hi');
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.change-order.status') }}",
                    data: {
                        status: status,
                        id: id
                    },

                    success: function(data) {
                        // console.log(data);
                        if (data.status === 'success') {
                            toastr.success(data.message);
                        }

                    },
                    error: function() {
                        if (data.status !== 'success') {
                            toastr.error(data.message);
                        }
                    }
                })
            })

            // Change Payment Status
            $('#payment_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');


                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.change-payment.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function() {
                        if (data.status !== 'success') {
                            toastr.error(data.message);
                        }
                    }
                })


            })

            $('.print_invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();

                $('body').html(printBody.html());
                window.print();

                $('body').html(originalContents);
            })

        })
    </script>
@endpush
