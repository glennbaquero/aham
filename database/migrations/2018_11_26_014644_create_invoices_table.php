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
            $table->date('purchase_date')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('file_extension')->nullable();
            $table->date('date_of_purchase')->nullable();
            $table->date('expiration_date')->nullable();
            $table->date('applied_date')->nullable();
            $table->string('application_number')->nullable();
            $table->string('proof_purchase')->nullable();
            $table->string('pytdet')->nullable();
            $table->string('dcode')->nullable();
            $table->integer('warranty_type');
            $table->boolean('has_notified')->default(0);
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
