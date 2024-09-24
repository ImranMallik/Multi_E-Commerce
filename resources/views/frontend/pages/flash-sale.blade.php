@extends('frontend.layouts.master')
@section('title')
    {{ $settings->site_name }} || Flash Sale
@endsection
@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>offer detaila</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="javascript:;">offer details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/assets/images/offer_banner_2.png') }}" alt="offrt img"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/assets/images/offer_banner_3.png') }}" alt="offrt img"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($flashSaleItems as $flashItem)
                        @php
                            $product = \App\Models\Product::find($flashItem->product_id);
                        @endphp
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ productType($product->product_type) }}</span>
                                @if (hasDiscounts($product))
                                    <span
                                        class="wsus__minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}%</span>
                                @endif
                                <a class="wsus__pro_link" href="{{ route('products-details', $product->slug) }}">
                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                        class="img-fluid w-100 img_1" />
                                    <img src="
  
                              @if (isset($product->multiplesImages[0]->image)) {{ asset($product->multiplesImages[0]->image) }}
  
                              @else 
                              {{ asset($product->thumb_image) }} @endif
                              
                              "
                                        alt="product" class="img-fluid w-100 img_2" />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category"
                                        href="{{ route('products-details', $product->slug) }}">{{ $product->category->name }}
                                    </a>
                                    <p class="wsus__pro_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(133 review)</span>
                                    </p>
                                    <a class="wsus__pro_name" title="{{ $product->name }}"
                                        href="{{ route('products-details', $product->slug) }}">
                                        {{ limitText($product->name, 15) }}
                                    </a>
                                    @if (hasDiscounts($product))
                                        <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->offer_price }}
                                            <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->price }}</p>
                                    @endif
                                    <a class="add_cart" href="#">add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5">
                    @if ($flashSaleItems->hasPages())
                        {{ $flashSaleItems->links() }}
                    @endif

                </div>
            </div>
        </div>
    </section>
    @foreach ($flashSaleItems as $items)
        @php
            $product = \App\Models\Product::find($items->product_id);
        @endphp
        <section class="product_popup_modal">
            <div class="modal fade" id="exampleModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="far fa-times"></i></button>
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                    <div class="wsus__quick_view_img">
                                        @if ($product->video_link)
                                            <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                                href="{{ $product->video_link }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        @endif
                                        <div class="row modal_slider">
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>

                                            @if (count($product->multiplesImages) === 0)
                                                {
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                            class="img-fluid w-100">
                                                    </div>
                                                </div>
                                                }
                                            @endif

                                            @foreach ($product->multiplesImages as $Image)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($Image->image) }}" alt="{{ $product->name }}"
                                                            class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="wsus__pro_details_text">
                                        <a class="title" href="#">{{ $product->name }}</a>
                                        <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>
                                        @if (hasDiscounts($product))
                                            <h4>{{ $settings->currency_icon }}{{ $product->offer_price }}<del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                            </h4>
                                        @else
                                            <h4>{{ $settings->currency_icon }}{{ $product->price }}</h4>
                                        @endif
                                        <p class="review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span>20 review</span>
                                        </p>
                                        <p class="description">{!! $product->short_description !!}</p>

                                        <form class="shopping-cart-form">
                                            <div class="wsus__selectbox">
                                                <div class="row">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    @foreach ($product->productVariants as $item)
                                                        @if ($item->status != 0)
                                                            <div class="col-xl-6 col-sm-6">
                                                                <h5 class="mb-2">{{ $item->name }}:</h5>
                                                                <select class="select_2" name="variants_item[]">
                                                                    @foreach ($item->variantItems as $variantItem)
                                                                        @if ($variantItem->status != 0)
                                                                            <option value="{{ $variantItem->id }}"
                                                                                {{ $variantItem->is_defult == 1 ? 'selected' : '' }}>
                                                                                {{ $variantItem->name }}
                                                                                ({{ $settings->currency_icon }}{{ $variantItem->price }})
                                                                            </option>
                                                                        @endif
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endforeach


                                                </div>
                                            </div>

                                            <div class="wsus__quentity">
                                                <h5>quentity :</h5>
                                                <div class="select_number">
                                                    <input class="number_area" name="qty" type="text"
                                                        min="1" max="100" value="1" />
                                                </div>
                                            </div>

                                            <ul class="wsus__button_area">
                                                <li><button type="submit" class="add_cart" href="#">add to
                                                        cart</button>
                                                </li>
                                                <li><a class="buy_now" href="#">buy now</a></li>
                                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                                <li><a href="#"><i class="far fa-random"></i></a></li>
                                            </ul>
                                        </form>
                                        <p class="brand_model"><span>brand :</span>{{ $product->Brand->name }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var d = new Date(),
                countUpDate = new Date();
            d.setDate(d.getDate() + 90);
            simplyCountdown('.simply-countdown-one', {
                year: {{ date('Y', strtotime($flashSaleDate->end_date)) }},
                month: {{ date('m', strtotime($flashSaleDate->end_date)) }},
                day: {{ date('d', strtotime($flashSaleDate->end_date)) }},
                enableUtc: true
            });


        })
    </script>
@endpush
