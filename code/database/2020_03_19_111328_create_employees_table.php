<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('Eid'); // Primary Key
            $table->string('Ename'); 
            $table->integer('EAge'); 
            $table->string('ECity');
            $table->string('E_Street');
            $table->string('E_House#');
            $table->integer('E_Basic_Salary');
            $table->integer('E_Bonus')->nullable();
            $table->enum('E_Rank', ['Manager', 'Developer','Admin'])->nullable(false);
            $table->enum('E_Department', ['HR','CS','IT','Labour'])->default('CS')->nullable(false);
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
