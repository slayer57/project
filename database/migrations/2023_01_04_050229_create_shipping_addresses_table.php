<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('apartment')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->bigInteger('user_id')->nullable();

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
        Schema::dropIfExists('shipping_addresses');
    }
}
