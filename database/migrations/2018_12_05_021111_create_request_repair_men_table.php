<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestRepairMenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_repair_men', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('repair_service_request_id')->unsigned()->index();
            $table->integer('admin_id')->unsigned()->index();
            $table->integer('status')->default(10); // 10 -> pending, 20 -> ongoing, 30 -> complete
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
        Schema::dropIfExists('request_repair_men');
    }
}
