<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.paypal-settings.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Paypal Status</label>
                    <select name="status" class="form-control" required>
                        <option {{ $paypal_setting->status === 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $paypal_setting->status === 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="account_mode" class="form-control" required>
                        <option {{ $paypal_setting->pay_mode === 1 ? 'selected' : '' }} value="1">Live</option>
                        <option {{ $paypal_setting->pay_mode === 0 ? 'selected' : '' }} value="0">Sandbox</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country_name" class="form-control select2" required>
                        <option value="">Select</option>
                        @foreach (config('setting.country_list') as $country)
                            <option {{ $country === $paypal_setting->country_name ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" class="form-control select2" required>
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $key => $currency)
                            <option {{ $currency === $paypal_setting->currency_name ? 'selected' : '' }}
                                value="{{ $currency }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Rate (Per USD)</label>
                    <input type="number" step="0.01" name="currency_rate"
                        value="{{ $paypal_setting->currency_rate }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Paypal Client Id</label>
                    <input type="text" name="client_id" value="{{ $paypal_setting->client_id }}"
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Paypal Secret Key</label>
                    <input type="text" name="secret_key" value="{{ $paypal_setting->secret_key }}"
                        class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>
