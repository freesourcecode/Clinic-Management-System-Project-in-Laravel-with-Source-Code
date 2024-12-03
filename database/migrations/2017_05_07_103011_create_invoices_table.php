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
            $table->integer('user_id')->unsigned();
            $table->string('invoice_no')->nullable();
            $table->string('payment_type')->default('Cash');
            $table->string('comment')->nullable();
            $table->float('total_amount');
            $table->float('sub_total', 28,21);
            $table->float('tax_amount', 28,21);
            $table->float('discount')->nullable();
            $table->float('cash')->nullable();
            $table->integer('patient_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
         $table->dropForeign('invoices_user_id_foreign'); 
          $table->dropForeign('invoices_patient_id_foreign'); 

    }
}
