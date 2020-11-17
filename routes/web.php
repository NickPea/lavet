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

Route::get('', 'SearchController@welcome');
Route::get('/search', 'SearchController@searchResultsPartial');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** View Main Objects */
//profile
Route::get('profile/{profile}', 'ProfileController@show');
Route::get('listing/{listing}', 'ListingController@show');
Route::get('event/{event}', 'EventController@show');

Route::patch('profile/{profile}', 'ProfileController@update');

Route::post('profile/{profile}/experience', 'ExperienceController@store');
Route::post('profile/{profile}/reference', 'ReferenceController@store');

Route::delete('experience/{experience}', 'ExperienceController@destroy');
