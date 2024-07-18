@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.update', $banner->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img width="200px" src="{{ asset($banner->banner) }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="banner" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" name="type" value="{{ $banner->type }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ $banner->title }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Starting Price</label>
                                    <input type="text" name="starting_price" value="{{ $banner->starting_price }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Button URL</label>
                                    <input type="text" name="btn_url" value="{{ $banner->btn_url }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Serial</label>
                                    <input type="text" name="serial" value="{{ $banner->serial }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <select id="inputState" name="status" class="form-control">
                                        <option {{ $banner->status == 1 ? 'Selected' : '' }} value="1">Active</option>
                                        <option {{ $banner->status == 0 ? 'Selected' : '' }} value="0">Inactive
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
