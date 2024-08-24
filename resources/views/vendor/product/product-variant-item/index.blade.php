@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">

                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <a href="{{ route('vendor.products-variant.index', ['product' => $product->id]) }}"
                            class="btn btn-primary mb-4"><i class="fas fa-arrow-left"></i> Back</a>
                        <h3><i class="fab fa-shopify"></i> Product Variant Item</h3>
                        <hr>
                        <h6>Variant:{{ $variant->name }}</h6>
                        <hr>

                        <div class="create_btn mb-3">
                            <a href="{{ route('vendor.product-variant-item.create', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                                class="btn btn-primary"><i class="fas fa-plus"></i> Create Variant Item</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{ $dataTable->table() }}
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                //    alert('Hello');
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);
                let id = $(this).data('id');
                // console.log(id);

                $.ajax({
                    url: "{{ route('vendor.product-variant-item.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })

            })
        })
    </script>
@endpush
