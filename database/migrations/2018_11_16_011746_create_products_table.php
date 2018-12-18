<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index();
            $table->integer('type_id')->unsigned()->index();
            $table->string('model');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('specification')->nullable();
            $table->decimal('extended_amount')->nullable();
            $table->string('brand')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->string('manual_path')->nullable();

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
        Schema::dropIfExists('products');
    }
}
