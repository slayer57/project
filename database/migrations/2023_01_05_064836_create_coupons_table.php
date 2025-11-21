<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('promo_name')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_value')->nullable();
            $table->string('coupon_type')->nullable();
            $table->string('cart_value')->nullable();
            $table->longText('description')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('coupons');
    }
}
