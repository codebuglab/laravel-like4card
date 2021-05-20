<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLike4CardProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like4_card_products', function (Blueprint $table) {
            $table->unsignedBigInteger("id")->primary(); // equals to remote id
            $table->unsignedBigInteger("like4_card_category_id");
            $table->string("name");
            $table->integer("price");
            $table->integer("sell_price");
            $table->string("image");
            $table->string("currency");
            $table->boolean("available");
            $table->integer("vat_percentage");
            $table->json("optional")->nullable();
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
        Schema::dropIfExists('like4_card_products');
    }
}
