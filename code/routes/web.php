<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', 'AdminController@index'); // The Home Page For Admin

// Admin Panel--------------------------Start

Route::get('/admin', 'AdminController@index')->name('adminhome'); // The Home Page For Admin

Route::get('/newspaper', 'AdminController@newspapersIndex')->name('newspaper'); // The Page For Newspapers Related Info With CRUD 

Route::post('/newspaper-new', 'AdminController@newspapersCreate'); // The route for a new newspaper source

Route::post('/newspaper-edit', 'AdminController@newspaperEdit'); // The route for a new newspaper source

Route::post('/newspaper/{newspaper}/togglestatus', 'AdminController@newspaperToggleStatus'); // The route for block/unblocking a newspaper source

Route::post('/newspaper/{newspaper}/delete', 'AdminController@newspaperDelete'); // The route for deleting a newspaper source

Route::get('/articles', 'AdminController@articlesIndex'); // The route for articles index

Route::get('/articles/new', 'AdminController@articlesCreate'); // The route for articles index

Route::post('/articles/new', 'AdminController@articlesStore'); // The route for articles index

Route::get('/articles/broken', 'AdminController@articlesBroken'); // The route for articles index

Route::post('/articles/broken', 'AdminController@articlesRepair'); // The route for articles index

Route::get('/actors', 'AdminController@actorsIndex'); // the route for actors Index

// Admin Panel--------------------------End



Route::post('/newspaper-nodes', 'AdminController@newNodes');
Route::get('/getActors', 'AdminController@getActors');



// Route::get('/getActors', function(){
// 	dd('here');
// });




Route::get('/lab1', 'AdminController@lab');







Route::get('/test','AdminController@test');


Route::get('/getArticles', 'AdminController@getArticles');

// Route::get('/refresh', function(){
// 	dd('here');
// });

Route::get('/getPolarities', 'AdminController@getPolarities');


Route::get('/sentiment', function() {

if (PHP_SAPI != 'cli') {
	echo "<pre>";
}

$strings = array(
	1 => "However, despite the number of coronavirus cases in the country skyrocketing on a daily basis, the premier ruled out a country-wide lockdown.

\"For now we have enforced a ban on all public gatherings. But we are one step behind imposing a total lockdown like in Karachi,\"Imran said.

\"There is a reason for this. Our situation cannot be compared to, for example, Italy; their per capita income and their [economic] situation are much better than ours.

\"If we impose a nationwide lockdown, we fear for our daily wage workers and labourers. What will they do for the next [few] weeks?\"

Keeping these things in mind, the prime minister said, the government has decided to introduce incentives for the construction industry that will be announced next week, on Tuesday.

\"The objective of this is to provide people with employment and to keep the economy running. We do not have the means during this lockdown [....] we don't want that we try to save people from corona but they end up dying due to hunger and poverty.\"

The second con of a nationwide lockdown, is its effect on the healthcare sector, potentially disrupting supplies and affecting front-line healthcare workers, he said.",
	
);

// my current logic
dump('start-logic');
$analyzer = new \Sentiment\Analyzer();

$sentence = 'The United States is helping Pakistan in fight against novel coronavirus with initial funding worth one million dollars. US Principal Deputy Assistant Secretary of State for South and Central Asian Affairs, Alice Wells Friday said the United States would provide one million dollars to Pakistan under USAID programme to bolster the monitoring and rapid response against Coronavirus.Pakistan is grappling with spread of the pandemic of pneumonic disease with over 440 confirmed infections across the country.In a tweet, she said that U.S. and Pakistan both are longstanding partners in tackling global health challenges. “The U.S. government is responding to #COVID-19 in #Pakistan with initial $1 million in USAID Pakistan funding to bolster monitoring & rapid response,”  said the US official. She further said that there are over hundred Pakistani graduates engaged in the lab training of Centers for Disease Control  and Prevention, investigating Coronavirus cases in Punjab and Gilgit Baltistan.';
$result = $analyzer->getSentiment($sentence);

dump($result);

// dd('end-logic');
// my current logic



// require_once __DIR__ . '/../autoload.php';
$sentiment = new \PHPInsight\Sentiment();

foreach ($strings as $string) {

	// calculations:
	$scores = $sentiment->score($string);
	$class = $sentiment->categorise($string);

	// output:
	echo "String: $string\n";
	echo "Dominant: $class, scores: ";
	print_r($scores);
	echo "\n";
}
	
});

Route::get('/sent',function(){

	dd('Logic-End');
});
