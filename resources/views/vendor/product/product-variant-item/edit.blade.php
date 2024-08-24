@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    {{-- <div class="mb-3">
                        <a href="{{ route('vendor.products-variant.index',['product'=>$productVariant->product_id])}}" class="btn btn-primary">Back</a>
                    </div> --}}
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fab fa-shopify"></i> Update Variant Item</h3>
                        {{-- <h5>Product: {{ $product->name }}</h5> --}}
                        {{-- <h4>Product:{{ $product->name }}</h4> --}}

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form method="POST"
                                    action="{{ route('vendor.product-variant-item.update', $variantItem->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group wsus__input">
                                        <label>Variant Name</label>
                                        <input type="text" name="variant_name"
                                            value="{{ $variantItem->ProductVariant->name }}" class="form-control" readonly>
                                    </div>
                                    {{-- <div class="form-group">
                                        <input type="hidden" name="variant_id" value="{{  $productVariant->id }}" class="form-control">
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                                    </div> --}}

                                    <div class="form-group wsus__input">
                                        <label>Price <code>(set 0 for make it free)</code></label>
                                        <input type="text" name="price" value="{{ $variantItem->price }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Item Name</label>
                                        <input type="text" name="name" value="{{ $variantItem->name }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="status">Is Default</label>
                                        <select id="status" name="is_default" class="form-control form-control-lg">
                                            <option value="">Select</option>
                                            <option {{ $variantItem->is_default == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $variantItem->is_default == 0 ? 'selected' : '' }} value="0">No
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control form-control-lg">
                                            <option {{ $variantItem->status == 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $variantItem->status == 0 ? 'selected' : '' }} value="0">
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
