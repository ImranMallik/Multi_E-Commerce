<?php
// Admin Route 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\SellerPendingProductController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRouleController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Models\ChildCategory;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// Profile Link------------
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile-update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');
// Slider Route---------
Route::resource('slider', SliderController::class);

// Category Route------
Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);
// Sub-Category Route------
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

// Child-Category---------
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::resource('child-category', ChildCategoryController::class);

// Brand Route--------
Route::put('brands/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);
//Admin Vendor Profile-----------
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Product Route---------
Route::get('products/get-sub-categories', [ProductController::class, 'get_subCategory'])->name('get-subcategory');
Route::get('products/get-child-categories', [ProductController::class, 'get_childCategory'])->name('get-childCategory');
Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);
// -----------------Product Image Gallery Route------------
// Route::resource('products/image-gallery', ProductImageGalleryController::class);
Route::resource('product-image-gallery', ProductImageGalleryController::class);
// Product Variant Routs
Route::put('change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

//  ----------Product Variant Items Route ----------
Route::get('products-variants-items/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variants-items.index');

Route::get('products-variants-items-create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variants-items.create');

Route::post('store/products-variants-items', [ProductVariantItemController::class, 'store'])->name('products-variants-items.store');

Route::put('product-variant-item/change-status', [ProductVariantItemController::class, 'itemChangeStatus'])->name('product-variant-item.change-status');

Route::get('edit/products-variants-items/{id}', [ProductVariantItemController::class, 'editProductVariantItem'])->name('products-variants-items.edit');

Route::post('update/products-variants-items/{id}', [ProductVariantItemController::class, 'updateProductVariantItem'])->name('products-variants-items.update');

Route::delete('delete/products-variants-items/{id}', [ProductVariantItemController::class, 'destroyProductVariantItem'])->name('products-variants-items.destroy');

// All Seller Product
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products');

// Seller Pending Product
Route::get('seller-pending-products', [SellerPendingProductController::class, 'pendingProducts'])->name('seller-pending-products');
Route::put('seller-approve-products', [SellerPendingProductController::class, 'productApproved'])->name('product.approve');

// Flash Sale 
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale/products-add', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale-status', [FlashSaleController::class, 'statusChange'])->name('flash-sale.status-change');
Route::put('flash-sale-status/show-at-home', [FlashSaleController::class, 'showAtHome'])->name('flash-sale.show-at-home');
Route::delete('flash-sale/{id}/destory', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');

// General Settings Route
Route::get('general-settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('general-settings-update', [SettingController::class, 'update'])->name('settings.update');

// Coupon Route
Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.status-change');
Route::resource('coupons', CouponController::class);

// Shipping Rule 
Route::put('shipping-rules-status-change', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rules-status-change');
Route::resource('shipping-rules', ShippingRuleController::class);
