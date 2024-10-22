<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RezorPaySetting;
use Illuminate\Http\Request;

class RazorPaySettingController extends Controller
{
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'status' => ['required', 'integer'],
            'country_name' => ['required', 'max:200'],
            'currency_name' => ['required', 'string', 'max:200'],
            'currency_rate' => ['required'],
            'razorpay_key' => ['required'],
            'razorpay_secret_key' => ['required']
        ]);

        RezorPaySetting::updateOrCreate(
            ['id' => $id],
            [
                'status' => $request->status,
                'country_name' => $request->country_name,
                'currency_name' => $request->currency_name,
                'currency_rate' => $request->currency_rate,
                'razorpay_key' => $request->razorpay_key,
                'razorpay_secret_key' => $request->razorpay_secret_key,
            ]
        );



        return redirect()->back()->with('success', 'Payment gateway setup successfully!');
    }
}
