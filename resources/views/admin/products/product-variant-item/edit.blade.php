@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>

        </div>


        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product Variant Item</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ route('admin.products-variants-items.update', $variantItem->id) }}">
                                @csrf

                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" value="{{ $variantItem->variant->name }}" class="form-control"
                                        readonly>
                                </div>

                                <input type="hidden" name="variant_id" value="{{ $variantItem->product_variant_id }}">

                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" value ="{{ $variantItem->name }}" name="name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Price<code>(Set 0 for make it free)</code></label>
                                    <input type="text" value="{{ $variantItem->price }}" name="price"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Is Default</label>
                                    <select id="status" name="is_default" class="form-control form-control-lg">
                                        <option value="">Select</option>
                                        <option {{ $variantItem->is_default == 1 ? 'selected' : '' }} value="1">Yes
                                        </option>
                                        <option {{ $variantItem->is_default == 0 ? 'selected' : '' }} value="0">No
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
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
    </section>
@endsection
