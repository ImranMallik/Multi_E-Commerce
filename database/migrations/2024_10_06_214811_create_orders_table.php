<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->integer('user_id');
            $table->double('subtotal');
            $table->double('amount');
            $table->string('currency_name');
            $table->string('currency_icon');
            $table->integer('product_qty');
            $table->integer('payment_method');
            $table->integer('payment_status');
            $table->text('order_address');
            $table->string('shipping_method');
            $table->string('coupon');
            $table->integer('order_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
