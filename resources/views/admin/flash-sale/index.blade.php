@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash Sale End Date</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status">Sale End Date</label>
                                        <input type="text" class="form-control datepicker" name="end_date"
                                            value="{{ @$flashSaleDate->end_date }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Flash Sale Products</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.add-product') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="status">Add Product</label>
                                    <select name="add_product" id="" class="form-control select2">
                                        <option>Select Product</option>
                                        @foreach ($product as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Show at home?</label>
                                            <select name="show_home" id="" class="form-control select2">
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="" class="form-control select2">
                                                <option>Select</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Flash Sale Products</h4>

                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <style>
        .table-row {
            border-bottom: 1px solid #e0e0e0;
        }

        .table-row:last-child {
            border-bottom: none;
        }
    </style>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // change status
            $('body').on('click', '.change-status', function() {
                //    alert('Hello');
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);
                let id = $(this).data('id');
                // console.log(id);

                $.ajax({
                    url: "{{ route('admin.flash-sale.status-change') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })

            })
            // change show at home
            $('body').on('click', '.show-at-home', function() {
                //    alert('Hello');
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);
                let id = $(this).data('id');
                // console.log(id);

                $.ajax({
                    url: "{{ route('admin.flash-sale.show-at-home') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })

            })
        })
    </script>
@endpush
