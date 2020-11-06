<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('', 'SearchController@firstLoad');
Route::get('/search', 'SearchController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/** View Main Objects */
//profile
Route::get('profile/{profile}', 'ProfileController@show');
Route::get('listing/{listing}', 'ListingController@show');
Route::get('event/{event}', 'EventController@show');