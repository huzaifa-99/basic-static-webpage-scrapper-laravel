<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('name'); 
            $table->longText('info')->nullable(true); 
            $table->text('pictures')->nullable(true); 
            $table->string('thumbnail')->nullable(true);
            $table->string('cardInfo')->nullable(true); 
            $table->integer('profileViews')->default(0); 
            $table->integer('appearedIn')->default(0);
            $table->boolean('is_active')->default(1); 
            $table->string('added_by')->default('system');  
            $table->timestamps(); 
            $table->integer('updateCount')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actors');
    }
}
