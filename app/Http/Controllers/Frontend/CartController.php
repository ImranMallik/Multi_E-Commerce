<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{

    // Add To Cart Logic
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($request->product_id);

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
        return view('frontend.pages.cart_details', compact('cartItems'));
    }


    //Update Cart Item Quantity
    public function updateQuantity(Request $request)
    {
        // dd($request->all());
        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->updateTotalPrice($request->rowId);
        return response(['status' => 'success', 'message' => 'Product Quantity Updated!', 'productTotal' => $productTotal]);
    }

    //When Product Quantity Update Then Total Price Update
    public function updateTotalPrice($rowId)
    {
        $product =  Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }
}
