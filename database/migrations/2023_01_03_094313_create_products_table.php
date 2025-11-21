<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->double('price')->nullable();
            $table->double('mrp')->nullable();
            $table->boolean('is_popular')->default(0);
            $table->double('discount')->nullable();

            $table->longText('specification')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('status')->default(0);
            $table->string('slug')->nullable();
            $table->string('tag')->nullable();
            $table->integer('rating')->nullable();

            $table->string('warranty_duration')->nullable();
            $table->string('easy_return')->nullable();
            $table->string('service_center')->nullable();

            $table->string('seo_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->longText('seo_schema')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
