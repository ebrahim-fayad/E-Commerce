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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->references('id')->on('sellers')->cascadeOnDelete();
            $table->string('shop_name')->nullable();
            $table->string('shop_phone')->nullable();
            $table->string('shop_address')->nullable();
            $table->text('shop_description')->nullable();
            $table->string('shop_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
