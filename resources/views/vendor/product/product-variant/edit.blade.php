@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="mb-3">
                        <a href="{{ route('vendor.products-variant.index', ['product' => $productVariant->product_id]) }}"
                            class="btn btn-warning"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fab fa-shopify"></i> Update Variant</h3>
                        {{-- <h5>Product: {{ $product->name }}</h5> --}}
                        {{-- <h4>Product:{{ $product->name }}</h4> --}}

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form method="POST"
                                    action="{{ route('vendor.products-variant.update', $productVariant->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group wsus__input">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $productVariant->name }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control form-control-lg">
                                            <option {{ $productVariant->status == 1 ? 'selected' : '' }} value="1">
                                                Active</option>
                                            <option {{ $productVariant->status == 0 ? 'selected' : '' }} value="0">
                                                Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
