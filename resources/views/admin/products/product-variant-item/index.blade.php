@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Item</h1>

        </div>
        <div class="mb-3">
            {{-- <button class="btn btn-primary">Back</button> --}}
            <a href="{{ route('admin.products-variant.index', ['product' => $product->id]) }}"
                class="btn btn-primary">Back</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Products</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.products-variants-items.create', $variant->id) }}"
                                    class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
