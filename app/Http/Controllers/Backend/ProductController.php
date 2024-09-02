<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Str;

class ProductController extends Controller
{
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $brand = Brand::all();
        return view('admin.products.create', compact('categories', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'product_type' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'status' => ['required']
        ]);
        $products = new Product();
        $imagePath = $this->uploadImage($request, 'image', 'uploads');
        $products->thumb_image = $imagePath;
        $products->name = $request->name;
        $products->slug = Str::slug($request->name);
        $products->category_id = $request->category;
        $products->sub_category_id = $request->sub_category;
        $products->child_category_id = $request->child_category;
        $products->vendor_id = Auth::user()->vendor->id;
        $products->brand_id = $request->brand;
        $products->sku = $request->sku;
        $products->price = $request->price;
        $products->offer_price = $request->offer_price;
        $products->offer_start_date = $request->offer_start_date;
        $products->offer_end_date = $request->offer_end_date;
        $products->qty = $request->qty;
        $products->video_link = $request->video_link;
        $products->product_type = $request->product_type;
        $products->short_description = $request->short_description;
        $products->long_description = $request->long_description;
        $products->seo_title = $request->seo_title;
        $products->seo_description = $request->seo_description;
        $products->is_approved = 1;
        $products->status = $request->status;
        $products->save();

        toastr('Created Successfully!', 'status');
        return redirect()->route('admin.products.index');
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
        $editData = Product::findOrFail($id);
        $subCategories = SubCategory::where('category_id', $editData->category_id)->get();
        $childCategories = ChildCategory::where('subcategory_id', $editData->sub_category_id)->get();
        $categories = Category::all();
        $brand = Brand::all();
        return view('admin.products.edit', compact('editData', 'categories', 'subCategories', 'brand', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'product_type' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'status' => ['required']
        ]);

        $products = Product::findOrFail($id);
        $imagePath = $this->updateImage($request, 'image', 'uploads', $products->thumb_image);
        $products->thumb_image = empty(!$imagePath) ? $imagePath : $products->thumb_image;
        $products->name = $request->name;
        $products->slug = Str::slug($request->name);
        $products->category_id = $request->category;
        $products->sub_category_id = $request->sub_category;
        $products->child_category_id = $request->child_category;
        $products->vendor_id = Auth::user()->vendor->user_id;
        $products->brand_id = $request->brand;
        $products->sku = $request->sku;
        $products->price = $request->price;
        $products->offer_price = $request->offer_price;
        $products->offer_start_date = $request->offer_start_date;
        $products->offer_end_date = $request->offer_end_date;
        $products->qty = $request->qty;
        $products->video_link = $request->video_link;
        $products->product_type = $request->product_type;
        $products->short_description = $request->short_description;
        $products->long_description = $request->long_description;
        $products->seo_title = $request->seo_title;
        $products->seo_description = $request->seo_description;
        $products->is_approved = 1;
        $products->status = $request->status;
        $products->save();
        toastr('Updated Successfully!', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->deleteImage($product->thumb_image);
        $multipleImage = ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($multipleImage as $image) {
            $this->deleteImage($image->image);
            $image->delete();
        }
        $productVariant = ProductVariant::where('product_id', $product->id)->get();
        foreach ($productVariant as $variant) {
            $variant->variantItems()->delete();
            $variant->delete();
        }
        $product->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    // Get Sub Category
    public function get_subCategory(Request $request)
    {
        // dd($request->all());
        $subCategory = SubCategory::where('category_id', $request->id)->get();
        return response()->json($subCategory);
    }
    // Get Child Category
    public function get_childCategory(Request $request)
    {
        $child_category = ChildCategory::where('subcategory_id', $request->id)->get();
        return response()->json($child_category);
    }

    // Change Status
    public function changeStatus(Request $request)
    {
        $category = Product::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
