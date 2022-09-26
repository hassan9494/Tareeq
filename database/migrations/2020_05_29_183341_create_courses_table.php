<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('weeks');
            $table->integer('session_number')->nullable();
            $table->integer('session_time');
            $table->date('start_from');
            $table->string('status')->default('open');
            $table->enum('application',['zoom','teamLink']);
            $table->boolean('free')->default(0);
            $table->text('comment')->nullable();
            $table->boolean('student_approve')->default(null);
            $table->boolean('teacher_approve')->default(null);
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
        Schema::dropIfExists('courses');
    }
}
