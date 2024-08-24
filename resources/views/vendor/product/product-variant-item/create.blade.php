@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="mb-3">
                        <a href="{{ route('vendor.product-variant-item.index', ['productId' => $product->id, 'variantId' => $productVariant->id]) }}"
                            class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fab fa-shopify"></i> Create Product Variant</h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form method="POST" action="{{ route('vendor.product-variant-item.store') }}">
                                    @csrf

                                    <div class="form-group wsus__input">
                                        <label>Name</label>
                                        <input type="text" name="variant_name" value="{{ $productVariant->name }}"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <input type="hidden" name="variant_id" value="{{ $productVariant->id }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Price <code>(set 0 for make it free)</code></label>
                                        <input type="text" name="price" class="form-control">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Item Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="status">Is Default</label>
                                        <select id="status" name="is_default" class="form-control form-control-lg">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control form-control-lg">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
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
