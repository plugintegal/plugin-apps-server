<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("event_id")->unsigned();
            $table->integer("category_id")->unsigned();
            $table->Integer("price");

            $table->foreign("event_id")->references("id")->on("events")->onDelete("CASCADE");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("CASCADE");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_events');
    }
}
