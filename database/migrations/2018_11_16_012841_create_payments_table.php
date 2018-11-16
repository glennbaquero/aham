<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_prod_id')->unsigned()->index();
            $table->foreign('user_prod_id')->references('id')->on('user_products')->onDelete('cascade');
            $table->integer('payment_method');
            $table->string('bank');
            $table->string('payment');
            $table->string('reference_code');
            $table->string('payment_gateway_code');
            $table->string('discount_code')->nullable();
            $table->decimal('total')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('payments');
    }
}
