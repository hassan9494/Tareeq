<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->integer('age')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('readArabic')->nullable();
            $table->bigInteger('whatsApp')->nullable();
            $table->string('course')->nullable();


            $table->string('status')->default('new');
            $table->boolean('views')->default(0);
            $table->bigInteger('user_id')->unsigned()->nullable();
            // $table->bigInteger('product_id')->unsigned();
            // $table->date('date');
            // $table->time('time');
            // $table->string('note')->nullable();
            $table->timestamps();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->bigInteger('teacher_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
