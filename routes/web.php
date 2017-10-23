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
<<<<<<< HEAD
Route::get('/activities', 'ActivitiesController@index')->name('activities');
=======
Route::get('/activities', 'ActivitiesController@index');
Route::get('/leaderboard', 'LeaderboardController@index');
>>>>>>> d7c0d745f276eb09ec513e45e3f8cf20482c468c
