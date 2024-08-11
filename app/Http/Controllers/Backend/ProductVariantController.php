<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.products.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_id' => ['required', 'integer'],
            'name' => ['string', 'max:200'],
            'status' => ['required']
        ]);
        $productVarient = new ProductVariant();
        $productVarient->product_id = $request->product_id;
        $productVarient->name = $request->name;
        $productVarient->status = $request->status;
        $productVarient->save();
        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.products-variant.index', ['product' => $request->product_id]);
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
        $variant = ProductVariant::findOrFail($id);
        return view('admin.products.product-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['string', 'max:200'],
            'status' => ['required']
        ]);
        $productVarient = ProductVariant::findOrFail($id);
        // $productVarient->product_id = $request->product_id;
        $productVarient->name = $request->name;
        $productVarient->status = $request->status;
        $productVarient->save();
        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->route('admin.products-variant.index', ['product' => $productVarient->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variantItem = ProductVariantItem::where('product_variant_id', $variant->id)->count();
        if ($variantItem > 0) {
            return response(['status' => 'error', 'message' => 'Cannot delete this variant, it has items.']);
        }
        $variant->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    // change Status
    public function changeStatus(Request $request)
    {
        $productVarient = ProductVariant::findOrFail($request->id);
        $productVarient->status = $request->status == 'true' ? 1 : 0;
        $productVarient->save();

        return response(['message' => 'Status has been updated!']);
    }
}
