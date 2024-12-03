<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_report_id')->unsigned();
            $table->integer('test_reference_id')->unsigned();
            $table->string('result');
            $table->string('flag');
            $table->foreign('test_report_id')->references('id')->on('test_reports')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('test_reference_id')->references('id')->on('test_references')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('reference_results');
    }
}
