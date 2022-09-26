<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type',['student','teacher']);
            $table->string('phone')->nullable();
            $table->longText('qualifications')->nullable();
            $table->integer('age')->nullable();
            $table->string('academic_year')->nullable();
            $table->string('country')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsApp')->nullable();
            $table->string('zoom')->nullable();
            $table->string('teamLink')->nullable();
            $table->string('video')->nullable();
            $table->float('hourly_price')->nullable();
            $table->float('paid')->nullable();
            $table->float('remaining')->nullable();
            $table->boolean('approved')->default(0);
            $table->boolean('showHome')->default(0);
            $table->integer('classes')->default(0);
            $table->bigInteger('teacher_id')->nullable();
            $table->date('course_start_date')->nullable();
            $table->longText('course_days')->nullable();
            $table->bigInteger('course_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
