<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('questions', 'QuestionsController')->except('show');
// Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store'); 
Route::resource('questions.answers', 'AnswersController')->except(['index', 'create', 'show']); 
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');

Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

// Following routes to make the button favorite question work 
Route::post('/questions/{question}/favorites', 'FavoriteController@store')->name('questions.favorite'); 
Route::delete('/questions/{question}/favorites', 'FavoriteController@destroy')->name('questions.unfavorite'); 

// a route for voting for the question 
Route::post('/questions/{question}/vote', 'VoteQuestionController'); 

// route for voting the answers
Route::post('/answers/{answer}/vote', 'VoteAnswerController'); 