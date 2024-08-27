<?php

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
      break;
    case 'is_top':
      return 'Top';
      break;
    case 'is_best':
      return 'Best';
      break;
    case 'featured_product':
      return 'Featured';
      break;
    default:
      return '';
      break;
  }
}
