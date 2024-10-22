<div class="tab-pane fade" id="list-razorpay" role="tabpanel" aria-labelledby="list-razorpay-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.razor-pay-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>RazorPay Status</label>
                    <select name="status" class="form-control" required>
                        <option {{ $razor_pay_setting->status === 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $razor_pay_setting->status === 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>



                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country_name" class="form-control select2" required>
                        <option value="">Select</option>
                        @foreach (config('setting.country_list') as $country)
                            <option {{ $country === $razor_pay_setting->country_name ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" class="form-control select2" required>
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $key => $currency)
                            <option {{ $currency === $razor_pay_setting->currency_name ? 'selected' : '' }}
                                value="{{ $currency }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Rate (Per USD)</label>
                    <input type="number" step="0.01" name="currency_rate"
                        value="{{ $razor_pay_setting->currency_rate }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>RazorPay key</label>
                    <input type="text" name="razorpay_key" value="{{ $razor_pay_setting->razorpay_key }}"
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>RazorPay Secret Key</label>
                    <input type="text" name="razorpay_secret_key"
                        value="{{ $razor_pay_setting->razorpay_secret_key }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>
