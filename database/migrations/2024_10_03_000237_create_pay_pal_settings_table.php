<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pay_pal_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->boolean('pay_mode');
            $table->string('country_name');
            $table->string('currency_name');
            $table->string('currency_rate');
            $table->text('client_id');
            $table->text('secret_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_pal_settings');
    }
};
