<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerProductsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index(SellerProductsDataTable $dataTable)
    {
        // echo "Seller Product";
        // return view('admin.products.seller-product.index');
        return $dataTable->render('admin.products.seller-product.index');
    }
}
