@php
    $address = json_decode($order->order_address);
    // dd($address);
@endphp

@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fab fa-shopify"></i>Order Details</h3>
                        <div class="wsus__dashboard_profile">
                            <section class="invoice-print">
                                <div class="wsus__invoice_area">
                                    <div class="wsus__invoice_header">
                                        <div class="wsus__invoice_content">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                    <div class="wsus__invoice_single">
                                                        <h5>Billing Information</h5>
                                                        <h6>{{ $address->name }}</h6>
                                                        <p>{{ $address->email }}</p>
                                                        <p>{{ $address->phone }}</p>
                                                        <p>{{ $address->address }},{{ $address->city }},{{ $address->state }}
                                                        </p>
                                                        <p>{{ $address->country }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                    <div class="wsus__invoice_single text-md-center">
                                                        <h5>shipping information</h5>
                                                        <h6>{{ $address->name }}</h6>
                                                        <p>{{ $address->email }}</p>
                                                        <p>{{ $address->phone }}</p>
                                                        <p>{{ $address->address }},{{ $address->city }},{{ $address->state }}
                                                        </p>
                                                        <p>{{ $address->country }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-4">
                                                    <div class="wsus__invoice_single text-md-end">
                                                        <h5>Order id:#{{ $order->invoice_id }}</h5>
                                                        <p><b>Order
                                                                Status:
                                                                {{ config('order_status.order_status_admin')[$order->order_status]['status'] }}</b>
                                                        </p>
                                                        <p><b>Payment Method: {{ $order->payment_method }}</b> </p>
                                                        <p><b>Payment Status:</b>
                                                            <b>{{ $order->payment_status == 1 ? 'Complet' : 'Pending' }}</b>
                                                        </p>
                                                        <p><b>Transaction ID: {{ $order->transaction->transaction_id }}
                                                            </b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_description">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th data-width="40">#</th>

                                                        <th class="name">
                                                            product
                                                        </th>
                                                        <th class="name">
                                                            Vendor
                                                        </th>

                                                        <th class="amount">
                                                            amount
                                                        </th>

                                                        <th class="quentity">
                                                            quentity
                                                        </th>
                                                        <th class="total">
                                                            total
                                                        </th>
                                                    </tr>
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($order->orderproducts as $product)
                                                        @if ($product->vendor_id === Auth::user()->vendor->id)
                                                            @php
                                                                $variants = json_decode($product->variants);
                                                                $total += $product->unit_price * $product->quantity;
                                                            @endphp
                                                            <tr>
                                                                <td>{{ ++$loop->index }}</td>
                                                                <td class="name">
                                                                    <p>{{ $product->product_name }}</p>
                                                                    @foreach ($variants as $key => $value)
                                                                        <span>{{ $key }} :
                                                                            {{ $value->name }}
                                                                            ({{ $settings->currency_icon }}{{ $value->price }})
                                                                        </span>
                                                                    @endforeach
                                                                </td>
                                                                <td class="name">
                                                                    {{ $product->vendor->shop_name }}
                                                                </td>
                                                                <td class="amount">
                                                                    {{ $settings->currency_icon }}
                                                                    {{ $product->unit_price }}
                                                                </td>

                                                                <td class="quentity">
                                                                    {{ $product->quantity }}
                                                                </td>
                                                                <td class="total">
                                                                    {{ $settings->currency_icon }}
                                                                    {{ $product->unit_price * $product->quantity }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wsus__invoice_footer">

                                        <p><b>Total Amount : {{ $settings->currency_icon }}{{ $total }}</b> </p>
                                    </div>
                                </div>
                            </section>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form action="{{ route('vendor.order.status', $order->id) }}">
                                            <div class="form-group mt-5">
                                                <label for="" class="mb-2"><b>Order Status :</b></label>
                                                <select name="status" class="form-control" id="">
                                                    @foreach (config('order_status.order_status_vendor') as $key => $orderStatus)
                                                        <option {{ $order->order_status === $key ? 'selected' : '' }}
                                                            value="{{ $key }}">
                                                            {{ $orderStatus['status'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-primary mt-3">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8 d-flex justify-content-end align-items-start mt-5">
                                        <button class="btn btn-warning print_invoice">Print</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $('.print_invoice').on('click', function() {
            let printBody = $('.invoice-print');
            let originalContents = $('body').html();

            $('body').html(printBody.html());
            window.print();

            $('body').html(originalContents);
        })
    </script>
@endpush
