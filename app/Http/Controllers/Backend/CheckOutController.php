<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippigRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index()
    {
        $user_address = UserAddress::where('user_id', Auth::user()->id)->get();
        $shipping_roule = ShippigRule::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('user_address', 'shipping_roule'));
    }

    public function addressCreate(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required', 'max:200'],
            'phone' => ['required', 'max:15'],
            'email' => ['required', 'email'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'zip' => ['required'],
            'address' => ['required', 'max:300'],
        ]);
        $new_address = new UserAddress();
        $new_address->user_id = Auth::user()->id;
        $new_address->name = $request->name;
        $new_address->email = $request->email;
        $new_address->phone = $request->phone;
        $new_address->country = $request->country;
        $new_address->state =   $request->state;
        $new_address->city = $request->city;
        $new_address->zip = $request->zip;
        $new_address->address = $request->address;
        $new_address->save();
        toastr('Address Created Successfully!', 'success', 'Success');
        return redirect()->back();
    }


    public function placeOrder(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'shipping_method_id' => ['required', 'integer'],
            'shipping_address_id' => ['required', 'integer']
        ]);

        $shipping_method = ShippigRule::findOrfail($request->shipping_method_id);
        if ($shipping_method) {
            Session::put('shipping_method', [
                'id' => $shipping_method->id,
                'name' => $shipping_method->name,
                'cost' => $shipping_method->cost,
                'type' => $shipping_method->type,
            ]);
        }
        $shipping_address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        if ($shipping_address) {

            Session::put('shipping_address', $shipping_address);
        }

        return response(['status' => 'success', 'redirect_url' => route('user.payment')]);
    }
}
