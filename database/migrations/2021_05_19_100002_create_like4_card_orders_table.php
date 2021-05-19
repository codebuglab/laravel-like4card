<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLike4CardOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like4_card_orders', function (Blueprint $table) {
            $table->id();
            $table->integer("order_number");
            $table->integer("final_total");
            $table->string("currency");
            $table->string("create_date");
            $table->string("payment_method")->nullable();
            $table->string("current_status");
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
        Schema::dropIfExists('like4_card_orders');
    }
}
