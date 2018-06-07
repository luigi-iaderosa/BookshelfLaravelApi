<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('signup','Auth\LoginController@signUp');
Route::post('/login','Auth\LoginController@attempt')->middleware(
    # \App\Http\Middleware\LoginTrack::class,
    \App\Http\Middleware\LoginOutcomeTrack::class);
Route::post('/bookshelf','BookshelfController@addBookshelf');
Route::post('/bookshelf/book','BookshelfController@addToBookshelf');
Route::delete('/bookshelf/book/{id}','BookshelfController@removeFromBookshelf');
Route::post('/book','BookController@addBook');
Route::get('/books','BookController@allBooks');
Route::get('/book/{id}','BookController@getBook');
Route::get('/bookshelf/{id}','BookshelfController@getBookshelf');
