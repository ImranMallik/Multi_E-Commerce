@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>

        </div>
        <div class="mb-3">
            <a href="{{ route('admin.products-variants-items.index', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product Variant Item</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.products-variants-items.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" name="variant_name" value="{{ $variant->name }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="product_variant_id" value="{{ $variant->id }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Price<code>(Set 0 for make it free)</code></label>
                                    <input type="text" name="price" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Is Default</label>
                                    <select id="status" name="is_default" class="form-control form-control-lg">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
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
    </section>
@endsection
