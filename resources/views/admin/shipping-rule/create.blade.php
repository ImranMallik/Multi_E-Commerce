@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Shipping Rule</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Shipping Roule</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.shipping-rules.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Type</label>
                                    <select name="type" id="status" class="form-control shipping-type">
                                        <option value="flat_cost">Falt Cost</option>
                                        <option value="min_cost">Minimum Order Amount</option>
                                    </select>
                                </div>
                                <div class="form-group min_cost d-none">
                                    <label>Minimum Amount</label>
                                    <input type="text" name="min_cost" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" name="cost" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                        </div>
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
            $('body').on('change', '.shipping-type', function() {
                let value = $(this).val();
                // alert(value);
                if (value != 'min_cost') {
                    $('.min_cost').addClass('d-none');
                } else {
                    $('.min_cost').removeClass('d-none');
                }
            })
        })
    </script>
@endpush
