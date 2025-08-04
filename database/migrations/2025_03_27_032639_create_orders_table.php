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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->from(100001);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('order_placing_method', ['image', 'items'])->default('image');
            $table->text('user_order_image')->nullable();
            $table->text('user_inputed_items')->nullable();
            $table->tinyInteger('is_image_extracted')->default(0)->comment('0 => Not Extracted, 1 => Extracted');
            $table->text('note')->nullable();
            $table->double('delivery_charge')->default(0)->nullable();
            $table->double('order_total')->default(0)->nullable();
            $table->double('paid_amount')->default(0)->nullable();
            $table->enum('order_status', ['pending', 'accepted', 'processing', 'on_delivery', 'completed', 'rejected', 'delivery_complete'])->default('pending');
            $table->tinyInteger('status')->default(0)->nullable();
            $table->tinyInteger('is_viewed')->default(0)->nullable();
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
