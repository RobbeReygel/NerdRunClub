<?php


Route::get('/', 'IndexController@index')->name('index');
Route::get('/logout', 'LoginController@logout')->name('auth.logout');
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

Route::get('/profile', 'ProfileController@index')->name('profile.index');

Route::get('/login/redirect', 'AuthController@redirect')->name('auth.redirect');
Route::get('/login/callback', 'AuthController@callback');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/activities', 'ActivitiesController@index')->name('activities');