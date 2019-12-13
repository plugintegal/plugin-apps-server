<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoryEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('sub_category_events', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger("category_event_id")->unsigned();
          $table->string("sub_category_name");
          $table->integer("quota");
          $table->foreign("category_event_id")->references("id")->on("category_events")->onDelete("CASCADE");
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_category_events');
    }
}
