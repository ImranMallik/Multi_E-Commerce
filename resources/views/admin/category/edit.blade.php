@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Category</h1>
            <a href="{{ route('admin.category.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>

        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Categories</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Icon</label>
                                    <div>
                                        <button class="btn btn-primary data-selected-class="btn-danger"
                                            data-unselected-class="btn-info"" role="iconpicker"
                                            data-icon="{{ $category->icon }}" name="icon"></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <select id="inputState" name="status" class="form-control">
                                        <option {{ $category->ststus == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $category->ststus == 0 ? 'selected' : '' }} value="0">Inactive
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
