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
            $table->integer("id")->primary()->unsigned(); // equals to remote id
            $table->integer("category_id")->unsigned();
            $table->string("name");
            $table->integer("price");
            $table->integer("sell_price");
            $table->string("image");
            $table->string("currency");
            $table->boolean("available");
            $table->integer("vat_percentage");
            $table->json("optional");
            $table->timestamps();
        });

        Schema::table('like4_card_products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
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
