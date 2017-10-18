<?php


Route::get('/', 'IndexController@index');
Route::get('/logout', 'LoginController@logout');
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

Route::get('/login/redirect', 'LoginController@redirect');
Route::get('/login/callback', 'LoginController@callback');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/activities', 'ActivitiesController@index');