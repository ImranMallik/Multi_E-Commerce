<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" name="site_name" value="{{ @$generalSetting->site_name }}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label>Layout</label>
                    <select name="layout" class="form-control">
                        <option {{ $generalSetting->layout == 'LRT' ? 'selected' : '' }} value="LTR">LTR</option>
                        <option {{ $generalSetting->layout == 'RLT' ? 'selected' : '' }} value="RLT">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="text" name="contact_email" value="{{ @$generalSetting->contact_email }}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label>Default Currency Name</label>
                    <select name="currency_name" class="form-control select2" id="currency_name">
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $currency)
                            <option {{ @$generalSetting->currency_name == $currency ? 'selected' : '' }}
                                value="{{ $currency }} ">
                                {{ $currency }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Icon</label>
                    <input type="text" class="form-control" name="currency_icon"
                        value="{{ @$generalSetting->currency_icon }}" id="currency_icon">
                </div>
                <div class="form-group">
                    <label>Timezone</label>
                    <select name="time_zone" class="form-control select2" id="">
                        <option value="">Select</option>
                        @foreach (config('setting.time_zone') as $key => $time)
                            <option {{ @$generalSetting->time_zone == $key ? 'selected' : '' }}
                                {{ @$GenaralSetting->time_zone == $key ? 'selected' : '' }}
                                value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
