@extends('frontend.dashboard.latouts.master')
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.latouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fal fa-gift-card"></i>Update address</h3>
                        <div class="wsus__dashboard_add wsus__add_address">
                            <form method="POST" action="{{ route('user.address.update', $address->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="wsus__add_address_single">
                                            <label>name <b>*</b></label>
                                            <input type="text" name="name" value="{{ $address->name }}"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>email</label>
                                            <input type="email" name="email" value="{{ $address->email }}"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>phone <b>*</b></label>
                                            <input type="text" name="phone" value="{{ $address->phone }}"
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Country <b>*</b></label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="country">
                                                    <option value="">Select</option>
                                                    @foreach (config('setting.country_list') as $country)
                                                        <option {{ $country == $address->country ? 'selected' : '' }}
                                                            value="{{ $country }}">{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>State <b>*</b></label>
                                            <input type="text" name="state" value="{{ $address->state }}"
                                                placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>City<b>*</b></label>
                                            <input type="text" name="city" value="{{ $address->city }}"
                                                placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>zip code <b>*</b></label>
                                            <input name="zip" type="text" value="{{ $address->zip }}"
                                                placeholder="Zip Code">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Address <b>*</b></label>
                                            <input name="address" type="text" value="{{ $address->address }}"
                                                placeholder="Address">
                                        </div>
                                    </div>


                                    <div class="col-xl-6">
                                        <button type="submit" class="common_btn">Update</button>
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
