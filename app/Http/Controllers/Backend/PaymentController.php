<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\PayPalSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function index()
    {
        if (!Session::has('shipping_method') && !Session::has('shipping_address')) {
            return redirect()->route('user.checkout.index');
        }
        return view('frontend.pages.payment');
    }

    // Re - direct After Successful Payment
    public function paymentSuccess()
    {
        return view('frontend.pages.payment_success');
    }

    // After Payment Success Order Data Insert into DataBase
    public function storeOrderData($paymentMethod, $paymentStatus)
    {
        $general_setting = GeneralSetting::first();
        $order = new Order();
        $order->invoice_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->subtotal = getMainCartTotal();
        $order->amount = getFinalPayableAmount();
        $order->product_qty = \Cart::content()->count();
        $order->currency_name = $general_setting->currency_name;
        $order->currency_icon = $general_setting->currency_icon;
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('shipping_address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 0;
        $order->save();
    }


    // paypal config 
    public function paypalConfig()
    {
        $paypal_setting = PayPalSetting::first();
        $paypalConfig = [
            'mode'    => $paypal_setting->pay_mode == 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypal_setting->client_id,
                'client_secret'     => $paypal_setting->secret_key,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $paypal_setting->client_id,
                'client_secret'     => $paypal_setting->secret_key,
                'app_id'            => '',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypal_setting->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];

        return $paypalConfig;
    }



    // Paypal Payment
    public function payWithPaypal()
    {
        $config = $this->paypalConfig();
        $paypal_setting = PayPalSetting::first();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        //Calculate Payable Amount depending on Currency Rate 
        $total = getFinalPayableAmount();
        $payableTotalAmount = round($total * $paypal_setting->currency_rate, 2);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $payableTotalAmount,
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] !== null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }


    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('user.payment-success');
        }


        return redirect()->route('user.paypal.cancel');
    }

    public function paypalCancel()
    {
        toastr('Something went wrong Please try again later', 'error', 'Error');
        return redirect()->route('user.payment');
    }
}
