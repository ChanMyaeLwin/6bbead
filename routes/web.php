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

//Role and Permission
Route::get('/roles', 'RoleController@index')->name('roles.index');
Route::get('/roles/create', 'RoleController@create')->name('roles.create');
Route::post('/roles', 'RoleController@store')->name('roles.store');
Route::get('/roles/{id}', 'RoleController@show')->name('roles.show');
Route::get('/roles/{id}/edit','RoleController@edit')->name('roles.edit');
Route::patch('/roles/{id}/update','RoleController@update')->name('roles.update');
Route::delete('/roles/{id}/delete','RoleController@destroy')->name('roles.destroy');

//Users
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/create', 'UserController@create')->name('users.create');
// Route::post('/users/create', 'UserController@create')->name('users.create');
Route::post('/users', 'UserController@store')->name('users.store');
Route::get('/users/{id}', 'UserController@show')->name('users.show');
Route::get('/users/{id}/edit','UserController@edit')->name('users.edit');
Route::get('/users/{id}/assign','UserController@assign')->name('users.assign');
Route::patch('/users/{id}/store_assign','UserController@store_assign')->name('users.store_assign');
Route::patch('/users/{id}/update','UserController@update')->name('users.update');
Route::delete('/users/{id}/delete','UserController@destroy')->name('users.destroy');

// //User Assign
// Route::get('/assign_users', 'UserAssignController@index')->name('assign_users.index');
// Route::get('/assign_users/create', 'UserAssignController@create')->name('assign_users.create');
// Route::post('/assign_users', 'UserAssignController@store')->name('assign_users.store');
// Route::get('/assign_users/{id}', 'PlanContrUserAssignControlleroller@show')->name('assign_users.show');
// Route::get('/assign_users/{id}/edit','UserAssignController@edit')->name('assign_users.edit');
// Route::patch('/assign_users/{id}/update','UserAssignController@update')->name('assign_users.update');
// Route::delete('/assign_users/{id}/delete','UserAssignController@destroy')->name('assign_users.destroy');

//Plan
Route::get('/plans', 'PlanController@index')->name('plans.index');
Route::get('/plans/create', 'PlanController@create')->name('plans.create');
Route::post('/plans', 'PlanController@store')->name('plans.store');
Route::get('/plans/{id}', 'PlanController@show')->name('plans.show');
Route::get('/plans/{id}/edit','PlanController@edit')->name('plans.edit');
Route::get('/plans/{id}/createLevel','PlanController@createLevel')->name('plans.createLevel');
Route::get('/plans/{id}/choosePlanView','PlanController@choosePlanView')->name('plans.choosePlanView');
Route::patch('/plans/{id}/choosePlan','PlanController@choosePlan')->name('plans.choosePlan');
Route::patch('/plans/{id}/addLevel','PlanController@addLevel')->name('plans.addLevel');
Route::patch('/plans/{id}/update','PlanController@update')->name('plans.update');
Route::delete('/plans/{id}/delete','PlanController@destroy')->name('plans.destroy');
Route::get('/choosedplans', 'PlanController@choosedPlans')->name('plans.choosedPlans');
Route::get('/plans/{id}/startPlan','PlanController@startPlan')->name('plans.startPlan');
Route::post('/updatestatus','PlanController@updatestatus')->name('plans.updatestatus');
Route::get('/plans/{id}/viewPlanStatus','PlanController@viewPlanStatus')->name('plans.viewPlanStatus');
//Article
Route::get('/articles', 'ArticleController@index')->name('articles.index');
Route::get('/articles/create', 'ArticleController@create')->name('articles.create');
Route::post('/articles', 'ArticleController@store')->name('articles.store');
Route::get('/articles/{id}', 'ArticleController@show')->name('articles.show');
Route::get('/articles/{id}/edit','ArticleController@edit')->name('articles.edit');
Route::patch('/articles/{id}/update','ArticleController@update')->name('articles.update');
Route::delete('/articles/{id}/delete','ArticleController@destroy')->name('articles.destroy');
