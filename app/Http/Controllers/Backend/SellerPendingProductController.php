<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerPendingProductController extends Controller
{
    public function pendingProducts(SellerPendingProductsDataTable $dataTable)
    {

        return $dataTable->render('admin.products.seller-pending-product.index');
    }

    public function productApproved(Request $request)
    {
        $product = Product::find($request->id);
        $product->is_approved = 1;
        $product->save();
        return response(['message' => 'Status has been updated!']);
    }
}
