<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function getVendorId()
    {
        return $this->belongsTo(AdminVendor::class, 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Multiples Images

    public function multiplesImages()
    {
        return $this->hasMany(ProductImageGallery::class);
    }
}
