@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Sub Category</h1>
            <a href="{{ route('admin.child-category.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Child Categories</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.child-category.update', $childCategory->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control main-category" name="category_id" id="">
                                        <option value="">Select</option>
                                        @foreach ($category as $cate)
                                            <option {{ $cate->id == $childCategory->category_id ? 'selected' : '' }}
                                                value="{{ $cate->id }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Sub Category</label>
                                    <select id="status" name="subcategory"
                                        class="form-control form-control-lg sub-category">
                                        <option value="">Select</option>
                                        @foreach ($subCategory as $value)
                                            <option {{ $value->id == $childCategory->subcategory_id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $childCategory->name }}" name="name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <select id="inputState" name="status" class="form-control">
                                        <option {{ $childCategory->status == 1 ? 'select' : '' }} value="1">Active
                                        </option>
                                        <option {{ $childCategory->status == 0 ? 'select' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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
            $('body').on('change', '.main-category', function() {
                // alert('Hello');
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategories') }}",
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
    </script>
@endpush
