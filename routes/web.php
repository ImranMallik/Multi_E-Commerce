<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CheckOutController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductDetails;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin Login
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');



//User Dashboard Route
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('update.password');
    // User Address
    Route::resource('address', UserAddressController::class);
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/address-create', [CheckOutController::class, 'addressCreate'])->name('checkout.address-create');
    // place order
    Route::post('place-order', [CheckOutController::class, 'placeOrder'])->name('checkout.place-order');
    // Payment Method
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    // Re-direct Payment success Page After Successful payment
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment-success');
    // Payment Paypal 
    Route::get('payment/paypal', [PaymentController::class, 'payWithPaypal'])->name('payment.paypal');
    Route::get('payment/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('payment/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    // Stripe Payment
    Route::post('payment/stripe', [PaymentController::class, 'payWithStripe'])->name('payment.stripe');
    Route::get('stripe/payment/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/payment/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
    // RazorPay Payment
    Route::post('payment/RazorPay', [PaymentController::class, 'payWithRazorPay'])->name('payment.razorpay');
});

// Custom Flash Sale Controller
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

// Products Details
Route::get('products-details/{slug}', [FrontendProductDetails::class, 'showProducts'])->name('products-details');

// Cart Route
Route::post('add-t-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cartDetails');
Route::post('cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('cart-clear-all', [CartController::class, 'clearAllCartItem'])->name('cart.clearAllCartItem');
Route::get('cart-clear-per-item/{rowId}', [CartController::class, 'clearPerItem'])->name('cart.clearPerItem');
Route::get('cart-count', [CartController::class, 'getCount'])->name('cart.count');
Route::get('cart-sidebar-products', [CartController::class, 'getSidebarProducts'])->name('cart.sidebarProducts');
Route::post('remove-sidebar-cart-products', [CartController::class, 'removeCartSidebarProducts'])->name('remove-cart-sidebar-products');
Route::get('cart/sidebar-products-total', [CartController::class, 'cartTotal'])->name('total-cart-sidebar-products');

// Coupon Code
Route::get('apply-Coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
//Calculate Coupon Discount
Route::get('calculate-coupon-discount', [CartController::class, 'calculateCouponDiscount'])->name('calculate-coupon-discount');
