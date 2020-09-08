<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolaritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polarities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_id'); 
            $table->enum('system',['PHPSentimentAnalyzer','PHPInsight'])->default(null); //  PHPSentimentAnalyzer / PHPInsight
            $table->float('positive')->default(0); 
            $table->float('negative')->default(0); 
            $table->float('neutral')->default(0); 
            $table->boolean('is_active')->default(1); // 1 = Yes 0 = No
            $table->timestamps();
            $table->integer('updateCount')->default(0); 

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polarities');
    }
}
