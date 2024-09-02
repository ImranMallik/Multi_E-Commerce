@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Coupon</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Coupon</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.coupons.update', $editData->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $editData->name }}" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" value="{{ $editData->code }}" name="code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" value="{{ $editData->quantity }}" name="quantity"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Max Use Per Person</label>
                                    <input type="text" value="{{ $editData->max_use }}" name="max_use"
                                        class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="text" value="{{ $editData->start_date }}" name="start_date"
                                                class="form-control datepicker">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="text" value="{{ $editData->end_date }}" name="end_date"
                                                class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount_type">Discount Type</label>
                                            <select name="discount_type" id="discount_type" class="form-control">
                                                <option {{ $editData->discount_type == 'percent' ? 'selected' : '' }}
                                                    value="percent">Percentage (%)</option>
                                                <option {{ $editData->discount_type == 'amount' ? 'selected' : '' }}
                                                    value="amount">Amount ({{ $currency->currency_icon }})</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Descount Value</label>
                                            <input type="text" value="{{ $editData->discount_value }}"
                                                class="form-control" name="discount_value">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $editData->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $editData->status == 0 ? 'selected' : '' }} value="0">Inactive
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
