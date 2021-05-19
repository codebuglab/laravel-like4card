<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLike4CardSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like4_card_serials', function (Blueprint $table) {
            $table->id();
            $table->integer("like4_card_order_id")->unsigned();
            $table->integer("like4_card_product_id")->unsigned();
            $table->integer("serial_id");
            $table->string("serial_code");
            $table->string("serial_number")->nullable();
            $table->string("valid_to");
            $table->timestamps();
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
        Schema::dropIfExists('like4_card_serials');
    }
}
