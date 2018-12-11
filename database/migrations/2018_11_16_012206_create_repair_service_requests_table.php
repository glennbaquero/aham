<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_service_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            // $table->integer('repair_men_id')->unsigned()->index();   
            // $table->integer('request_repair_men_id')->unsigned()->index();
            $table->text('complaint')->nullable();
            $table->text('solution')->nullable();
            $table->string('ro_number')->nullable();
            $table->date('ro_date')->nullable();
            $table->decimal('repair_cost')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('repair_service_requests');
    }
}
