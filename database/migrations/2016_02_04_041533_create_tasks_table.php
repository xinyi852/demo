<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string("date");
            $table->string('department');
            $table->string('reporter');
            $table->longText('today_tasks')->nullable();
            $table->longText('today_works')->nullable();
            $table->longText('tomorrow_tasks')->nullable();
            $table->longText("idea")->nullable();
            $table->longText("reply")->nullable();
            $table->integer("status")->nullable();
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
        Schema::drop('tasks');
    }
}
