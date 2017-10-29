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

// questions
Route::get('/question/view','QuestionController@index');
Route::get('/question/askquestion','QuestionController@index');

// api
Route::get('/api/question/get','QuestionController@get');
Route::post('/api/question/create','QuestionController@create');

