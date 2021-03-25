<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('order_price', 6,2);
            $table->decimal('delivery_price', 6,2);
            $table->time('delivery_time');
            $table->decimal('discount', 4,2);
            $table->decimal('final_price', 6,2);
            $table->string('guest_name');
            $table->string('guest_lastname');
            $table->string('guest_address');
            $table->string('guest_city');
            $table->string('guest_mobile');
            $table->string('guest_email');
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
        Schema::dropIfExists('orders');
    }
}
