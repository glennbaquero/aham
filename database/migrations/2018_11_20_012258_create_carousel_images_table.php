<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('carousel_id')->default(0)->unsigned()->index();
            // $table->integer('order_column')->unsigned();

            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();

            $table->string('image_path')->nullable();
            
            $table->string('banner_link')->nullable();

            $table->longText('content')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            
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
        Schema::dropIfExists('carousel_images');
    }
}
