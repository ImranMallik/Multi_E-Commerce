@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fab fa-shopify"></i>Products</h3>
                        <div class="create_btn mb-3">
                            <a href="{{ route('vendor.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Create Product</a>
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
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('body').on('click', '.change-status', function() {
                //    alert('Hello');
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);
                let id = $(this).data('id');
                // console.log(id);

                $.ajax({
                    url: "{{ route('vendor.product.change-status') }}",
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
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
