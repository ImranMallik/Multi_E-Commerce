@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Products</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Category</label>
                                        <select id="category" name="category" class="form-control main-category">
                                            <option>Select</option>
                                            @foreach ($categories as $categori)
                                                <option value="{{ $categori->id }}">{{ $categori->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Sub Category</label>
                                        <select id="sub_category" name="sub_category" class="form-control sub-category">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Child Category</label>
                                        <select id="child_category" name="child_category"
                                            class="form-control child-category">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Brand</label>
                                        <select id="child_category" name="brand" class="form-control">
                                            <option>Select</option>
                                            @foreach ($brand as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Sku</label>
                                        <input type="text" value="{{ old('sku') }}" name="sku"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Price</label>
                                        <input type="text" name="price" value="{{ old('price') }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label>Offer Price</label>
                                        <input type="text" name="offer_price" value="{{ old('offer_price') }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Offer Start Date</label>
                                        <input type="text" name="offer_start_date" value="{{ old('offer_start_date') }}"
                                            class="form-control datepicker">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Offer End Date</label>
                                        <input type="text" name="offer_end_date" value="{{ old('offer_end_date') }}"
                                            class="form-control datepicker">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Stock Quantity</label>
                                        <input type="number" min="0" name="qty" value="{{ old('qty') }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Video Link</label>
                                        <input type="text" min="0" name="video_link"
                                            value="{{ old('video_link') }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Product Type</label>
                                        <select name="product_type" class="form-control">
                                            <option>Select</option>
                                            <option value="is_top">Is Top</option>
                                            <option value="new_arrival">New Arrival</option>
                                            <option value="is_best">Is Best</option>
                                            <option value="is_fetured">Is Fetured</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description"class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long_description" class="form-control summernote"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Seo Title</label>
                                    <input type="text" name="seo_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Seo Description</label>
                                    <textarea name="seo_description" class="form-control" cols="30" rows="10"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
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
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategory') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.sub-category').html('<option value= "">Select</option>');
                        if (data.length > 0) {
                            $.each(data, function(i, item) {
                                $('.sub-category').append(
                                    `<option value="${item.id}">${item.name}</option>`
                                );
                            });
                        } else {
                            $('.sub-category').append(
                                `<option value="">No Sub category</option>`
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
            // Get Child Category
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                // alert(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-childCategory') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.child-category').html('<option value= "">Select</option>');
                        if (data.length > 0) {
                            $.each(data, function(i, item) {
                                $('.child-category').append(
                                    `<option value="${item.id}">${item.name}</option>`
                                );
                            });
                        } else {
                            $('.child-category').append(
                                `<option value="">No child category</option>`
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
