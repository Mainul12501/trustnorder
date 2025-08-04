<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basic_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_title')->nullable();
            $table->text('site_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->text('corporate_office')->nullable();
            $table->text('fb')->nullable();
            $table->text('insta')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('skype')->nullable();
            $table->text('site_moto')->nullable();
            $table->text('seo_header')->nullable();
            $table->text('seo_footer')->nullable();
            $table->float('delivery_charge', 10, 2)->default(0)->nullable();
            $table
                ->tinyInteger('status')
                ->default(1)
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_settings');
    }
};
