<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
//            $table->string('number');
            $table->integer('amount');
            $table->string('to')->nullable();
            $table->string('paid_for')->nullable();
            $table->bigInteger('voucher_cat')->unsigned()->nullable();
//            $table->bigInteger('customer_id')->unsigned()->nullable();
//            $table->bigInteger('supplier_id')->unsigned()->nullable();
//            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
//            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

//            $table->foreign('supplier_id')->references('id')->on('suppliers');
//            $table->foreign('customer_id')->references('id')->on('customers');
//            $table->foreign('employee_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
//            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
