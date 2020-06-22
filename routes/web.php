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

Route::get('/plans', 'PlanController@index')->name('plans.index');
Route::get('/plans/create', 'PlanController@create')->name('plans.create');
Route::post('/plans', 'PlanController@store')->name('plans.store');
Route::get('/plans/{id}', 'PlanController@show')->name('plans.show');
Route::get('/plans/{id}/edit','PlanController@edit')->name('plans.edit');
Route::patch('/plans/{id}/update','PlanController@update')->name('plans.update');
Route::delete('/plans/{id}/delete','PlanController@destroy')->name('plans.destroy');
	

Route::get('/articles', 'ArticleController@index')->name('articles.index');
