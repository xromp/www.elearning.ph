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
Route::get('/api/question/get','QuestionController@get');
Route::get('/api/question/categories','QuestionController@getCategories');
Route::get('/api/question/getQuestions','QuestionController@getQuestions');
Route::post('/api/question/create','QuestionController@create');

// stock market
Route::get('/stockmarket/view','StockMarketController@index');
Route::get('/stockmarket/category/{categorycode}','StockMarketController@index');

// api
Route::get('/stockmarket/stockmarket/getcategory','QuestionController@getCategory');

// answer

// api
Route::post('/api/v1/answer/save','AnswerController@save');

//login
Route::get('/login','AccountController@index');
Route::post('/auth','AccountController@auth');
Route::get('/logout','AccountController@logout');

//for checking purposes only
Route::get('/sess','QuestionController@sess'); //show specific value of a session
Route::get('/sess_flush','QuestionController@sess_flush'); //remove specific session

// Category

// Category api
Route::get('/api/v1/category/get','CategoryController@get');
Route::get('/api/v1/category/getWithAnswer','CategoryController@getWithAnswer');

// Type

// Type api
Route::get('/api/v1/type/get','TypeController@get');