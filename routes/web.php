<?php


Route::get('/test', 'LoginController@test');
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

<<<<<<< HEAD
Route::get('/login/redirect', 'LoginController@redirectToStrava');
Route::get('/login/callback', 'LoginController@callback');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/activities', 'ActivitiesController@index');
=======
Route::get('/login/redirect', 'LoginController@redirect');
Route::get('/login/callback', 'LoginController@callback');
>>>>>>> 101091e8b25476508c4624acb8efcef88aca3ee5
