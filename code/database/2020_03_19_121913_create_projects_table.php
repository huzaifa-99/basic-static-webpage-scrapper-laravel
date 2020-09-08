<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('p_id'); // Primary Key
            $table->string('pName'); 
            $table->string('p_bonus'); 
            $table->string('duration_in_months');
            $table->unsignedBigInteger('Eid');
            $table->timestamps();

            $table->foreign('Eid')->references('Eid')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
