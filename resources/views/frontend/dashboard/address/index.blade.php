@extends('frontend.dashboard.latouts.master')
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.latouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <h3><i class="fal fa-gift-card"></i> address</h3>
                        <div class="wsus__dashboard_add">
                            <div class="row">
                                @foreach ($address as $addresses)
                                    <div class="col-xl-6">
                                        <div class="wsus__dash_add_single">
                                            <h4>Billing Address</h4>
                                            <ul>
                                                <li><span>name :</span>{{ $addresses->name }}</li>
                                                <li><span>Phone :</span> {{ $addresses->phone }}</li>
                                                <li><span>email :</span>{{ $addresses->email }}</li>
                                                <li><span>country :</span> {{ $addresses->country }}</li>
                                                <li><span>city :</span> {{ $addresses->city }}</li>
                                                <li><span>State :</span> {{ $addresses->state }}</li>
                                                <li><span>zip code :</span> {{ $addresses->zip }}</li>
                                                {{-- <li><span>company :</span> N/A</li> --}}
                                                <li><span>address :</span> {{ $addresses->address }}</li>
                                            </ul>
                                            <div class="wsus__address_btn">
                                                <a href="{{ route('user.address.edit', $addresses->id) }}" class="edit"><i
                                                        class="fal fa-edit"></i>
                                                    edit</a>
                                                <a href="{{ route('user.address.destroy', $addresses->id) }}"
                                                    class="del delet-item mx-2"><i class="fal fa-trash-alt"></i>
                                                    delete</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    <a href="{{ route('user.address.create') }}" class="add_address_btn common_btn"><i
                                            class="far fa-plus"></i>
                                        add new address</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
