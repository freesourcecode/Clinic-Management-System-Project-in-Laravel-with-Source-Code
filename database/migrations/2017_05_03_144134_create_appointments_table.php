<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('time')->nullable();
            $table->timestamp('appointment_date')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('patient_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
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
        Schema::dropIfExists('appointments');
        $table->dropForeign('appointments_patient_id_foreign');
        $table->dropForeign('appointments_doctor_id_foreign'); 
    }
}
