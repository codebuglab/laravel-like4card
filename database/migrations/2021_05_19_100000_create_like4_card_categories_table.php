<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLike4CardCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like4_card_categories', function (Blueprint $table) {
            $table->unsignedBigInteger("id")->primary(); // equals to remote id
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->string("name");
            $table->string("image");
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
        Schema::dropIfExists('like4_card_categories');
    }
}
