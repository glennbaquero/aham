<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('invoice_id')->nullable()->unsigned()->index();

            $table->decimal('unit_price', 9, 2)->unsigned();
            $table->decimal('discount', 9, 2)->default(0)->unsigned();
            $table->decimal('total_price', 9, 2)->unsigned();
            $table->boolean('status')->default(0);

            $table->boolean('on_repair')->default(0);
            
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
        Schema::dropIfExists('invoice_items');
    }
}
