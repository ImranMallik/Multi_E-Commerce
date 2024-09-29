<?php

use Illuminate\Support\Facades\Session;

function setActive(array $route)
{
  if (is_array($route)) {
    foreach ($route as $r) {
      if (request()->routeIs($r)) {
        return 'active';
      }
    }
  }
}

// Check if Product have discounts available

function hasDiscounts($product)
{
  $currentDate = date('Y-m-d');
  if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
    return true;
  }
  return false;
}

// Discount Calculate for Product 
function calculateDiscountPercent($originalPrice, $discountPrice)
{
  $discount = $originalPrice - $discountPrice;
  $discountPercent = ($discount / $originalPrice) * 100;
  return round($discountPercent);
}

// Check Product Type

function productType(string $type): string
{
  switch ($type) {
    case 'new_arrival':
      return 'New';
    case 'is_top':
      return 'Top';
    case 'is_best':
      return 'Best';
    case 'featured_product':
      return 'Featured';
    default:
      return '';
  }
}

// name text length set 

function limitText($text, $limit = 15)
{
  return \Str::limit($text, $limit);
}

// Gat Total cart Amount

function getCartTotal()
{
  $total = 0;
  foreach (\Cart::content() as $product) {
    $total += ($product->price + $product->options->variants_total) * $product->qty;
  }
  return $total;
}


// get main cart total or you have to pay this amount using coupon
function getMainCartTotal()
{
  if (Session::get('coupon')) {
    $coupon_data = Session::get('coupon');
    if ($coupon_data['discount_type'] === 'amount') {
      $total = getCartTotal() - $coupon_data['discount'];
      return $total;
    } elseif ($coupon_data['discount_type'] === 'percent') {
      $total = getCartTotal() - (getCartTotal() * $coupon_data['discount'] / 100);
      return $total;
    }
  } else {
    return getCartTotal();
  }
}

// Calculate Discount Amount using Coupon
function getCartDiscount()
{
  if (Session::get('coupon')) {
    $coupon_data = Session::get('coupon');
    if ($coupon_data['discount_type'] === 'amount') {
      return $coupon_data['discount'];
    } elseif ($coupon_data['discount_type'] === 'percent') {
      $discount = (getCartTotal() * $coupon_data['discount'] / 100);
      return $discount;
    }
  } else {
    return 0;
  }
}
