<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpdSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('opd_name');
            $table->integer('doctor_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->float('doctor_fee', 8,4);
            $table->float('opd_charge', 8,4);
            $table->boolean('status')->default(0);
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('opd_sales');
        $table->dropForeign('opd_sales_doctor_id_id_foreign');
        $table->dropForeign('opd_sales_invoice_id_foreign'); 
    }
}
