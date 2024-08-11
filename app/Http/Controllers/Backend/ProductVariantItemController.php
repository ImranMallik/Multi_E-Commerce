<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    //
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        // return view('admin.products.product-variant-item.index');
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return $dataTable->render('admin.products.product-variant-item.index', compact('variant', 'product'));
    }

    public function create(string $productId, string $variantId)
    {

        // dd($id);
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return view('admin.products.product-variant-item.create', compact('variant', 'product'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_variant_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'status' => ['required'],
            'is_default' => ['required'],
        ]);

        $varianItem = new ProductVariantItem();
        $varianItem->product_variant_id = $request->product_variant_id;
        $varianItem->price = $request->price;
        $varianItem->name = $request->name;
        $varianItem->status = $request->status;
        $varianItem->is_default = $request->is_default;
        $varianItem->save();
        toastr('Created Successfully');
        return redirect()->route('admin.products-variants-items.index', ['productId' => $request->product_id, 'variantId' => $request->product_variant_id]);
    }

    public function itemChangeStatus(Request $request)
    {

        $productVariant = ProductVariantItem::findOrFail($request->id);
        $productVariant->status = $request->status == 'true' ? 1 : 0;
        $productVariant->save();
        return response()->json(['status' => 'success', 'message' => 'Status changed successfully.']);
    }


    public function editProductVariantItem(string $id)
    {
        $variantItem = ProductVariantItem::findOrFail($id);
        return view('admin.products.product-variant-item.edit', compact('variantItem'));
    }

    public function updateProductVariantItem(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            // 'product_variant_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'status' => ['required'],
            'is_default' => ['required'],
        ]);

        $varianItem =  ProductVariantItem::findOrFail($id);
        $varianItem->product_variant_id = $request->variant_id;
        $varianItem->price = $request->price;
        $varianItem->name = $request->name;
        $varianItem->status = $request->status;
        $varianItem->is_default = $request->is_default;
        $varianItem->save();
        toastr('Updated Successfully');
        return redirect()->back();
    }

    public function destroyProductVariantItem(string $id)
    {
        // dd($id);
        $variantItem = ProductVariantItem::findOrFail($id);
        $variantItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
