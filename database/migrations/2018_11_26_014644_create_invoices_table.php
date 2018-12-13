<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->string('serial_number')->nullable();
            $table->date('purchase_date');
            $table->string('contract_number');
            $table->string('file_extension');
            $table->date('date_of_purchase');
            $table->date('expiration_date');
            $table->date('applied_date');
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
        Schema::dropIfExists('invoices');
    }
}
