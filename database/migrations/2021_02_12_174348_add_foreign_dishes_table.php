<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->nullable()->after('id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->unsignedBigInteger('menu_section_id')->nullable()->after('restaurant_id');
            $table->foreign('menu_section_id')->references('id')->on('menu_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->dropForeign('dishes_menu_section_id_foreign');
            $table->dropColumn('menu_section_id');
            $table->dropForeign('dishes_restaurant_id_foreign');
            $table->dropColumn('restaurant_id');
        });
    }
}
