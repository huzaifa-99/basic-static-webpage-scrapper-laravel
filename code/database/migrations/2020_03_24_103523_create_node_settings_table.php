<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('newspaper_id');
            $table->string('article')->nullable(true);
            $table->string('link')->nullable(true);
            $table->string('title')->nullable(true);
            $table->string('body')->nullable(true);
            $table->string('thumbnail')->nullable(true);
            $table->string('publisher')->nullable(true);
            $table->string('published_on')->nullable(true);
            $table->timestamps();

            $table->foreign('newspaper_id')->references('id')->on('newspapers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('node_settings');
    }
}
