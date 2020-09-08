<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewspapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newspapers', function (Blueprint $table) {
            $table->bigIncrements('id'); // primary key
            $table->string('name'); // the name of the newspaper in Sentence Case
            $table->string('link'); // the link from where to fetch the news
            $table->string('thumbnail'); // the logo of the newspaper for me to display
            $table->string('infoDomain'); // like politics/sports/health/bussiness/technology
            $table->integer('totalArticles')->default(0); // total articles of current newspaper
            $table->integer('totalViews')->default(0); // total views of all articles of this newspaper
            $table->boolean('is_active')->default(1); // 1 = Yes 0 = No
            $table->integer('updateCount')->default(0); // will increment/decrement on every obvert/revert
            $table->integer('added_by'); // the id of the admin who added the newspaper
            $table->timestamps(); // created_at and update_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newspapers');
    }
}
