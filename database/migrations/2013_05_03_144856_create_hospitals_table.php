<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slogan');
            $table->string('logo');
            $table->string('address');
            $table->string('contact');
            $table->string('email');
            $table->string('pan_no');
            $table->string('registration_no');
            $table->string('invoice_message')->nullable();
            $table->string('website')->nullable();
            $table->string('description')->nullable();
            $table->string('invoice_prefix')->default('LWC-');
            $table->string('patient_prefix')->default('LWC-');
            $table->string('tax_type')->nullabel();
            $table->integer('tax_percent');
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
        Schema::dropIfExists('hospitals');
    }
}
