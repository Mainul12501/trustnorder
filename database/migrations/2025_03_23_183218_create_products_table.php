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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('product_name');
            $table->double('price')->default(0)->nullable();
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();
            $table->text('sub_images')->nullable();
            $table->string('unit_name')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->double('available_stock')->default(0)->nullable();
            $table->tinyInteger('warning_amount')->default(1)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
