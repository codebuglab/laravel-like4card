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
            $table->unsignedBigInteger("like4_card_order_id");
            $table->unsignedBigInteger("like4_card_product_id");
            $table->integer("serial_id");
            $table->string("serial_code");
            $table->string("serial_number")->nullable();
            $table->string("valid_to");
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
        Schema::dropIfExists('like4_card_serials');
    }
}
