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
    // return view('welcome');
    return redirect('login');
});

// questions
Route::get('/question/view','QuestionController@index');
Route::get('/question/askquestion','QuestionController@index');
Route::get('/question/answerquestion/{questionid}','QuestionController@index');

// api
Route::get('/api/v1/question/get','QuestionController@get');
Route::get('/api/v1/question/categories','QuestionController@getCategories');
Route::get('/api/v1/question/getQuestions','QuestionController@getQuestions');
Route::post('/api/v1/question/create','QuestionController@create');
Route::get('/api/v1/question/leaderBoard','QuestionController@leaderBoard');

// stock market
Route::get('/stockmarket/view','StockMarketController@index');
Route::get('/stockmarket/category/{categoryCode}','StockMarketController@index');

// api
Route::get('/stockmarket/stockmarket/getcategory','QuestionController@getCategory');

// api
Route::post('/api/v1/answer/save','AnswerController@save');

//login
Route::get('/login','AccountController@index');
Route::post('/auth','AccountController@auth');
Route::post('/upload/image','AccountController@store');
Route::get('/logout','AccountController@logout');

//for checking purposes only
Route::get('/sess','QuestionController@sess'); //show specific value of a session
Route::get('/sess_flush','QuestionController@sess_flush'); //remove specific session

 
//for profile 
Route::get('/profile','ProfileController@index'); //show specific value of a session
Route::get('/profile/{id}','ProfileController@viewOtherProfile'); //show specific value of a session

//for leaderboard

//for leaderboard
Route::get('/leaderboard/index','LeaderboardController@Index'); 
// Route::get('/leaderboard/{id?}','LeaderboardController@Find');

//leaderboard api
Route::get('/api/v1/leaderboard/users','LeaderboardController@Users');
Route::get('/api/v1/leaderboard/topScorers','LeaderboardController@LeaderBoard');//get top 3 scorers
Route::post('/api/v1/leaderboard/find','LeaderboardController@Find');


//forums
Route::get('/forums/index','ForumsController@Index');
Route::get('/api/v1/forums/list','ForumsController@Forums');
Route::get('/api/v1/forums/comments','ForumsController@Comments');

//Posted Question API
Route::get('/api/v1/profile/user','ProfileController@User'); 
Route::post('/api/v1/profile/otherUser','ProfileController@OtherUser'); 
Route::post('/api/v1/profile/postedQuestions','ProfileController@PostedQuestions'); 

Route::get('/api/v1/profile/sampleCrypt/{id}','ProfileController@sampleCrypt'); 
 

// Category api
Route::get('/api/v1/category/get','CategoryController@get');
Route::get('/api/v1/category/getWithAnswer','CategoryController@getWithAnswer');

// Type

// Type api
Route::get('/api/v1/type/get','TypeController@get');

// Achievements API
Route::get('/api/v1/achievements/FirstQuestion','AchievementsController@FirstQuestion');
Route::post('/api/v1/achievements/Achievements','AchievementsController@Achievements');

Route::get('/sampleTrait','LeaderboardController@Achievements');
