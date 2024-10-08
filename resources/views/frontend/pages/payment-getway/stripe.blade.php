<div class="tab-pane fade show" id="v-pills-stripe" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.payment.stripe') }}" method="post" id="checkout-form">
                    @csrf
                    <input type="hidden" name="stripe_token" id="stripe-token-id">
                    <div id="card-element" class="form-control"></div>
                    <br />
                    <button class="nav-link common_btn text-center" href="{{ route('user.payment.stripe') }}"
                        onclick="createToken()" type="button" id="pay-btn">pay
                        with stripe</button>

                </form>
            </div>
        </div>
    </div>
</div>
@php
    $stripeSetting = \App\Models\StripeSetting::first();
@endphp

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let stripe = Stripe("{{ $stripeSetting->client_id }}");
        let elements = stripe.elements();
        let card = elements.create('card');
        card.mount('#card-element');

        function createToken() {
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(card).then(function(result) {
                if (typeof result.error != 'undefined') {
                    document.getElementById("pay-btn").disabled = false;
                    alert(result.error.message);
                }

                if (typeof result.token != 'undefined') {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById("checkout-form").submit();
                }
            });
        }
    </script>
@endpush
