<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleItem extends Model
{
    use HasFactory;

    protected $table = 'flash_sale_items';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
