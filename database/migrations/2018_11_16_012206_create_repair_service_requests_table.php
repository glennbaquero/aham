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
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('repair_man_id')->unsigned()->index();
            $table->foreign('repair_man_id')->references('id')->on('repair_men')->onDelete('cascade');
            $table->integer('warranty_id');
            $table->text('complaint')->nullable();
            $table->text('solution')->nullable();
            $table->string('ro_number');
            $table->date('ro_date');
            $table->decimal('repair_cost')->nullable();
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
        Schema::dropIfExists('repair_service_requests');
    }
}
