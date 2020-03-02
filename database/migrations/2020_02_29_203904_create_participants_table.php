<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->char('id', 12)->primary();
            $table->bigInteger('event_id')->unsigned();
            $table->bigInteger('sub_category_event_id')->unsigned();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->char('phone', 13)->unique();
            $table->string('institution');
            $table->text('address');
            $table->date('date_of_birth');
            $table->text('description');
            $table->integer('chair')->default(0);
            $table->boolean('payment')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('CASCADE');
            $table->foreign('sub_category_event_id')->references('id')->on('sub_category_events')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
