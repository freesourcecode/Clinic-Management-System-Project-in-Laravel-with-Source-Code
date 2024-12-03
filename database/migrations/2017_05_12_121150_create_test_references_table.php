<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_references', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('unit')->nullable();
            $table->string('range')->nullable();
            $table->integer('parent_id')->nullable()->unsigned();
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
        Schema::dropIfExists('test_references');
    }
}
