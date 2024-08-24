<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\DataTables\VendorProductVariantDataTable;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $dataTable)
    {
        // echo "Hi";
        $product = Product::findOrFail($request->product);
        if ($product->vendor_id !== Auth::user()->vendor->user_id) {
            abort(404);
        }

        return $dataTable->render('vendor.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'product' => ['required', 'integer'],
            'status' => ['required']
        ]);

        $productVariant = new ProductVariant();

        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;

        $productVariant->save();

        // toastr('Created Successfully!', 'success');
        return redirect()->route('vendor.products-variant.index', ['product' => $request->product])->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        // check vendor product owner
        if ($productVariant->Product->vendor_id !== Auth::user()->vendor->user_id) {
            abort(404);
        }
        return view('vendor.product.product-variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        // check vendor product owner
        if ($productVariant->Product->vendor_id !== Auth::user()->vendor->user_id) {
            abort(404);
        }

        // $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;

        $productVariant->save();

        // toastr('Created Successfully!', 'success');
        return redirect()->route('vendor.products-variant.index', ['product' => $productVariant->product_id])->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = ProductVariant::findOrFail($id);
        // check vendor product owner
        if ($product->Product->vendor_id !== Auth::user()->vendor->user_id) {
            abort(404);
        }
        $productVariantItem = ProductVariantItem::where('product_variant_id', $product->id)->count();
        if ($productVariantItem > 0) {
            return response(['status' => 'error', 'message' => 'This variant contain variant items in it delete the variant items first for delete this variant!']);
        }
        $product->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $product = ProductVariant::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }
}
