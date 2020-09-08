<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('newspaper_id'); // the id of the newspaper
            $table->string('title')->default('title'); // the title of the article
            $table->string('excerpt')->default('excerpt'); // the excerpt of the article
            $table->longText('body'); // the body of the article
            $table->string('thumbnail')->default('thumbnail'); // the thumbnail of the article
            $table->string('link')->default('link'); // the link from where article was fetched
            $table->string('publisher')->default('publisher'); // the article publisher
            $table->string('published_on')->default('published_on'); // the article published date

            $table->integer('views')->default(0); // total views of this article
            $table->string('polarity')->default(0); // the sentiments form the article  
            $table->boolean('is_active')->default(1); // 1=Yes  || 0=No
            $table->string('added_by')->default('system'); // either system or admin
            $table->timestamps();
            $table->integer('updateCount')->default(0); // how many times the article was fetched/edited.
            $table->integer('ratedFor')->default(0); //  0=unrated  || 1=ratedForSentiments ||  2=ratedForNouns || 3=ratedForActors

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
        Schema::dropIfExists('articles');
    }
}
