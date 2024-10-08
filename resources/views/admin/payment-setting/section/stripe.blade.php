<div class="tab-pane fade show" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.stripe-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Stripe Status</label>
                    <select name="status" class="form-control" required>
                        <option {{ $stripe_setting->status === 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $stripe_setting->status === 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="account_mode" class="form-control" required>
                        <option {{ $stripe_setting->pay_mode === 1 ? 'selected' : '' }} value="1">Live</option>
                        <option {{ $stripe_setting->pay_mode === 0 ? 'selected' : '' }} value="0">Sandbox</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country_name" class="form-control select2" required>
                        <option value="">Select</option>
                        @foreach (config('setting.country_list') as $country)
                            <option {{ $country === $stripe_setting->country_name ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" class="form-control select2" required>
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $key => $currency)
                            <option {{ $currency === $stripe_setting->currency_name ? 'selected' : '' }}
                                value="{{ $currency }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Rate (Per {{ $stripe_setting->currency_name }})</label>
                    <input type="number" step="0.01" name="currency_rate"
                        value="{{ $stripe_setting->currency_rate }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Stripe Client Id</label>
                    <input type="text" name="client_id" value="{{ $stripe_setting->client_id }}"
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input type="text" name="secret_key" value="{{ $stripe_setting->secret_key }}"
                        class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>
