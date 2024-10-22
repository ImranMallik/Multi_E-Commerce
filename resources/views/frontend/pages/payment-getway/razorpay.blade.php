<div class="tab-pane fade" id="v-pills-razorpay" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">

                <a class="nav-link common_btn text-center" href="{{ route('user.payment.paypal') }}">pay with Razorpay</a>
                <form action="{{ route('user.payment.razorpay') }}" method="POST">
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ $razorpay_key }}"
                        data-amount="{{ $amount }}" data-order_id="{{ $order_id }}" data-buttontext="Pay Now"
                        data-name="Your Company Name" data-description="Test Transaction" data-image="https://yourlogo.com/logo.png"
                        data-theme.color="#F37254"></script>
                </form>
            </div>
        </div>
    </div>
</div>
