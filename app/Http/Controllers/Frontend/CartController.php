<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    // Add To Cart Logic
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($request->product_id);
        //check if products quantity
        if ($product->qty === 0) {
            return response(['status' => 'error', 'message' => 'Product Out of Stock']);
        } elseif ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

        $variants = [];
        $variantTotalAmount = 0;

        if ($request->has('variants_items')) {
            foreach ($request->variants_items as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);

                $variants[$variantItem->variant->name]['name'] = $variantItem->name;
                $variants[$variantItem->variant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }


        $productPrice = 0;
        if (hasDiscounts($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }



        // dd($variants);
        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $product->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        // dd($cartData);

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Added to Cart Successfully!']);

        // dd($cartData);
    }


    // Cart Details Item
    public function cartDetails()
    {
        $cartItems = Cart::content();
        if (count($cartItems) === 0) {
            Session::forget('coupon');
            toastr('please add some products in your cart for view the cart page', 'warning', 'Cart is empty!');
            return redirect()->route('home');
        }
        return view('frontend.pages.cart_details', compact('cartItems'));
    }


    //Update Cart Item Quantity
    public function updateQuantity(Request $request)
    {
        // dd($request->all());
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        if ($product->qty === 0) {
            return response(['status' => 'error', 'message' => 'Product Out of Stock']);
        } elseif ($product->qty < $request->quantity) {
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->updateTotalPrice($request->rowId);
        return response(['status' => 'success', 'message' => 'Product Quantity Updated!', 'productTotal' => $productTotal]);
    }

    //When Product Quantity (increment && decrement) Update Then Total Price Update
    public function updateTotalPrice($rowId)

    {
        $product =  Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }
    // Cart Total Amount

    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $item) {
            $total += $this->updateTotalPrice($item->rowId);
        }
        return $total;
    }

    // clear All Cart Items
    public function clearAllCartItem()
    {
        // dd('hello');
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Cart was successfully cleared']);
    }
    // Clear Par Item
    public function clearPerItem($rowId)
    {
        // dd($rowId);
        Cart::remove($rowId);
        toastr('Item was removed successfully', 'success', 'Success');
        return redirect()->back();
    }

    // Cart Count
    public function getCount()
    {
        return Cart::content()->count();
    }

    // Get Cart Sidebar Products
    public function getSidebarProducts()
    {
        return Cart::content();
    }
    // remove Cart Sidebar Products
    public function removeCartSidebarProducts(Request $request)
    {
        // dd($request->all());
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' => 'Product removed from cart successfully']);
    }

    // Coupon 
    public function applyCoupon(Request $request)
    {
        // dd($request->all());
        if ($request->couponCode === null) {
            return response(['status' => 'error', 'message' => 'Coupon Code is required!']);
        }

        $coupon_code = Coupon::where(['code' => $request->couponCode, 'status' => 1])->first();

        // dd($coupon_code);
        if ($coupon_code === null) {
            return response(['status' => 'error', 'message' => 'Coupon not exists!']);
        } elseif ($coupon_code->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is not valid']);
        } elseif ($coupon_code->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is expired']);
        } elseif ($coupon_code->total_used >= $coupon_code->quantity) {
            return response(['status' => 'error', 'message' => 'You Can Not Apply This Coupon!']);
        }

        if ($coupon_code->discount_type === 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon_code->name,
                'coupon_code' => $coupon_code->code,
                'discount_type' => 'amount',
                'discount' => $coupon_code->discount_value
            ]);
        } elseif ($coupon_code->discount_type === 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon_code->name,
                'coupon_code' => $coupon_code->code,
                'discount_type' => 'percent',
                'discount' => $coupon_code->discount_value
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully']);
    }


    // calculate coupon discount value
    public function calculateCouponDiscount()
    {
        if (Session::get('coupon')) {
            $coupon_data = Session::get('coupon');
            if ($coupon_data['discount_type'] === 'amount') {
                $total = getCartTotal() - $coupon_data['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon_data['discount']]);
            } elseif ($coupon_data['discount_type'] === 'percent') {
                $total = getCartTotal() - (getCartTotal() * $coupon_data['discount'] / 100);
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon_data['discount']]);
            }
        } else {
            $total = getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }
}
