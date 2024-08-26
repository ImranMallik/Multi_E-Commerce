@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Vendor Profile</h1>

        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Vendor Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.vendor-profile.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img width="200px" src="{{ asset($vendor->banner) }}" alt="banner">
                                </div> --}}
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="banner" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Shop Name</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="summernote" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>FaceBook</label>
                                    <input type="text" name="fb_link" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="tw_link" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Instragram</label>
                                    <input type="text" name="insta_link" class="form-control">
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
