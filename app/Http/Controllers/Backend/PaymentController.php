<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        if (!Session::has('shipping_method') && !Session::has('shipping_address')) {
            return redirect()->route('user.checkout.index');
        }
        return view('frontend.pages.payment');
    }
}
