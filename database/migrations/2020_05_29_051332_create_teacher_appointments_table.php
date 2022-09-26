<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->time('sun_start')->nullable();
            $table->time('sun_end')->nullable();
            $table->time('mon_start')->nullable();
            $table->time('mon_end')->nullable();
            $table->time('tue_start')->nullable();
            $table->time('tue_end')->nullable();
            $table->time('wed_start')->nullable();
            $table->time('wed_end')->nullable();
            $table->time('thu_start')->nullable();
            $table->time('thu_end')->nullable();
            $table->time('fri_start')->nullable();
            $table->time('fri_end')->nullable();
            $table->time('sat_start')->nullable();
            $table->time('sat_end')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('teacher_appointments');
    }
}
