<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('order')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('slug')->nullable();
            $table->integer('parent_id')->nullable();

            $table->string('seo_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
