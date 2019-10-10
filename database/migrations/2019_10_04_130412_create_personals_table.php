<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->char('user_id', 10);
            $table->string('nickname')->nullable();
            $table->char('phone', 13)->unique()->nullable();
            $table->string('place_of_birth', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->char('nim', 8)->unique()->nullable();
            $table->string('telegram', 20)->unique()->nullable();
            $table->string('github', 30)->unique()->nullable();
            $table->char('class', 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('updated_at')->default(null)->nullable();

            $table->foreign('user_id')->references('member_id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personals');
    }
}
