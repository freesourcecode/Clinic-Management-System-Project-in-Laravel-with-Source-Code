<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->integer('age');
            $table->string('phone')->nullable();
            $table->enum('gender', array('Male', 'Female' , 'Other'));
            $table->string('birth_date')->nullable();
            $table->string('country')->default('Nepal');
            $table->string('state')->default('Bagmati');
            $table->string('district')->default('Kathmandu');
            $table->string('location')->nullable();
            $table->string('occupation')->nullable();
            $table->string('description')->nullable();
            $table->string('relative_name')->nullable();
            $table->string('relative_phone')->nullable();
            $table->enum('marital_status', array('single', 'married' , 'other'));
            $table->enum('blood_group', array('A+','A-','B+','AB+','AB-','B-','O+','O-'))->nullable();
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
        Schema::dropIfExists('patients');
    }
}
