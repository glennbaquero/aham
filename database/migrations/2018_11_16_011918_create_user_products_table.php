<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('serial_number')->nullable();
            $table->date('purchase_date');
            $table->string('contract_number');
            $table->string('file_extension');
            $table->date('date_of_purchase');
            $table->date('expiration_date');
            $table->date('applied_date');
            $table->decimal('amount');
            $table->string('application_number');
            $table->string('pytdet')->nullable();
            $table->string('dcode')->nullable();
            $table->integer('warranty_type');
            $table->softDeletes();
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
        Schema::dropIfExists('user_products');
    }
}
