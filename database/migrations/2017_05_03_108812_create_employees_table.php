<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('education')->nullable();
            $table->string('description')->nullable();
            $table->string('certificate')->nullable();
            $table->string('speciality')->nullable();
            $table->string('working_day')->nullable();
            $table->string('in_time')->nullable();
            $table->string('out_time')->nullable();
            $table->string('type')->nullable();
            $table->integer('department_id')->unsigned();
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
        Schema::dropIfExists('employees');
    }
}
