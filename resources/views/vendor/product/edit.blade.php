@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fab fa-shopify"></i>Edit Product</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.products.update', $product->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Preview</label>
                                        <br>
                                        <img class="rounded" src="{{ asset($product->thumb_image) }}" style="width:150px"
                                            alt="">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ $product->name }}"
                                            class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label for="status">Category</label>
                                                <select id="status" name="category"
                                                    class="form-control form-control-lg main-category">
                                                    <option value="">Select</option>
                                                    @foreach ($categories as $category)
                                                        <option
                                                            {{ $category->id == $product->category_id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label for="status">Sub Category</label>
                                                <select id="status" name="sub_category"
                                                    class="form-control form-control-lg sub-category">
                                                    <option value="">Select</option>
                                                    @foreach ($subcategory as $value)
                                                        <option
                                                            {{ $value->id == $product->sub_category_id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label for="status">Child Category</label>
                                                <select id="status" name="child_category"
                                                    class="form-control form-control-lg child-category">
                                                    <option value="">Select</option>
                                                    @foreach ($childCategory as $value)
                                                        <option
                                                            {{ $value->id == $product->child_category_id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="status">Brand</label>
                                        <select id="status" name="brand" class="form-control form-control-lg">
                                            <option value="">Select</option>
                                            @foreach ($brands as $brand)
                                                <option {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                                                    value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Sku</label>
                                        <input type="text" class="form-control" name="sku"
                                            value="{{ $product->sku }}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ $product->price }}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Offer Price</label>
                                        <input type="text" class="form-control" name="offer_price"
                                            value="{{ $product->offer_price }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group wsus__input">
                                                <label for="status">Offer Start Date</label>
                                                <input type="text" class="form-control datepicker" name="offer_start"
                                                    value="{{ $product->offer_start_date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group wsus__input">
                                                <label for="status">Offer End Date</label>
                                                <input type="text" class="form-control datepicker" name="offer_end"
                                                    value="{{ $product->offer_end_date }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="status">Stock Quantity</label>
                                        <input type="number" min="0" class="form-control" name="qty"
                                            value="{{ $product->qty }}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Video Link</label>
                                        <input type="text" class="form-control" name="video_link"
                                            value="{{ $product->video_link }}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Short Description</label>
                                        <textarea name="short_description" class="form-control">{{ $product->short_description }}</textarea>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Long Description</label>
                                        <textarea name="long_description" id="summernote" class="form-control summernote">{{ $product->long_description }}</textarea>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="status">Product Type</label>
                                        <select id="status" name="product_type" class="form-control form-control-lg">
                                            <option value="">Select</option>
                                            <option {{ $product->product_type == 'new_arrival' ? 'selected' : '' }}
                                                value="new_arrival">New Arrival</option>
                                            <option {{ $product->product_type == 'featured_product' ? 'selected' : '' }}
                                                value="featured_product">Featured</option>
                                            <option {{ $product->product_type == 'top_product' ? 'selected' : '' }}
                                                value="top_product">Top Product</option>
                                            <option {{ $product->product_type == 'best_product' ? 'selected' : '' }}
                                                value="best_product">Best Product</option>
                                        </select>
                                    </div>


                                    <div class="form-group wsus__input">
                                        <label for="status">Seo Title</label>
                                        <input type="text" class="form-control" name="seo_title"
                                            value="{{ $product->seo_title }}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="status">Seo Description</label>
                                        <textarea name="seo_description" class="form-control">{!! $product->seo_description !!}</textarea>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control form-control-lg">
                                            <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Inactive
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">Upload</button>
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

@push('scripts')
    <script>
        // Get Main Category Ajax---
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                $('.child-category').html(` <option value="">Select</option>`)
                // alert('Hello');
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.product.get-subcategories') }}",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.sub-category').html(` <option value="">Select</option>`)
                        $.each(data, function(i, item) {
                            $('.sub-category').append(
                                ` <option value="${item.id}">${item.name}</option>`)
                        })

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })

        // Get Child Category Ajax--
        $(document).ready(function() {
            $('body').on('change', '.sub-category', function() {
                // alert('Hello');
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.product.child-categories') }}",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.child-category').html(` <option value="">Select</option>`)
                        $.each(data, function(i, item) {
                            $('.child-category').append(
                                ` <option value="${item.id}">${item.name}</option>`)
                        })

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
