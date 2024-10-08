<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PayPalSetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypal_setting = PayPalSetting::first();
        $stripe_setting = StripeSetting::first();
        return view('admin.payment-setting.index', compact('paypal_setting', 'stripe_setting'));
    }
}
