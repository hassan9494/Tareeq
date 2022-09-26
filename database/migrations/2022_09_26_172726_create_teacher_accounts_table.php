<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

//            $table->string('type');

            $table->integer('amount');

            $table->string('to')->nullable();

            $table->string('paid_for')->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->bigInteger('lesson_id')->unsigned()->nullable();

            $table->string('note')->nullable();

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('lesson_id')->references('id')->on('course_lessons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_accounts');
    }
}
