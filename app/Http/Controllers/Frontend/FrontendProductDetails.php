<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductDetails extends Controller
{
    public function showProducts(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->first();
        return view('frontend.pages.products_details', compact('product'));
    }
}
