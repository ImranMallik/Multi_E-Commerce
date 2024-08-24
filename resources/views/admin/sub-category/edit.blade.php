@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Sub Category</h1>
            <a href="{{ route('admin.sub-category.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Sub Categories</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.sub-category.update', $subcategory->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="status">Category</label>
                                    <select id="status" name="category" class="form-control form-control-lg">
                                        <option value="">Select</option>
                                        @foreach ($category as $value)
                                            <option {{ $value->id == $subcategory->category_id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $subcategory->name }}" name="name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control form-control-lg">
                                        <option {{ $subcategory->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $subcategory->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
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
    </section>
@endsection
