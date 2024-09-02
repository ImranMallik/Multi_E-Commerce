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
                            <h4>Update Shipping Roule</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.shipping-rules.update', $shipping->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $shipping->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Type</label>
                                    <select name="type" id="status" class="form-control shipping-type">
                                        <option {{ $shipping->type === 'flat_cost' ? 'selected' : '' }} value="flat_cost">
                                            Falt Cost</option>
                                        <option {{ $shipping->type === 'min_cost' ? 'selected' : '' }} value="min_cost">
                                            Minimum Order Amount</option>
                                    </select>
                                </div>
                                <div class="form-group min_cost {{ $shipping->type === 'min_cost' ? '' : 'd-none' }}">
                                    <label>Minimum Amount</label>
                                    <input type="text" name="min_cost" value="{{ $shipping->min_cost }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" name="cost" value="{{ $shipping->cost }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $shipping->status === 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $shipping->status === 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
