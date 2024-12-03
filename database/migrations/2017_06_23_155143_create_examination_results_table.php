<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_report_id')->unsigned();
            $table->string('macroscopic_result');
            $table->string('microscopic_result');
            $table->string('result')->nullable();
            $table->foreign('test_report_id')->references('id')->on('test_reports')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('examination_results');
    }
}
