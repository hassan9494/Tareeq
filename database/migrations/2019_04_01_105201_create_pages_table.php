<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('parent_id')->nullable();
            $table->integer('order');
            $table->longText('name');
            $table->text('slug')->nullable();
            $table->boolean('inFooter')->default(false);
            $table->boolean('inNav')->default(false);
            $table->boolean('published')->default(false);
            $table->boolean('hasForm')->default(false);
            $table->dateTime('published_at')->nullable();
            $table->longText('content')->nullable();

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
        Schema::dropIfExists('pages');
    }
}
