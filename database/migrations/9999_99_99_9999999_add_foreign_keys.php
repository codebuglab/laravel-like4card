<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('like4_card_products', function (Blueprint $table) {
            $table->foreign('like4_card_category_id')->references('id')->on('categories');
        });

        Schema::table('like4_card_serials', function (Blueprint $table) {
            $table->foreign('like4_card_order_id')->references('id')->on('like4_card_orders');
            $table->foreign('like4_card_product_id')->references('id')->on('like4_card_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
