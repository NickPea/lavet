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


Route::get('profile/{profile}', 'ProfileController@show'); //?section = "..."


Route::get('listing/{listing}', 'ListingController@show');
Route::get('event/{event}', 'EventController@show');


Route::post('profile/{profile}/location', 'LocationController@store');
Route::post('profile/{profile}/experience', 'ExperienceController@store');
Route::post('profile/{profile}/reference', 'ReferenceController@store');


Route::put('profile/{profile}/header', 'ProfileController@updateHeader');
Route::put('profile/{profile}/profile-image', 'ProfileController@updateProfileImage');


Route::patch('profile/{profile}', 'ProfileController@update');


Route::delete('experience/{experience}', 'ExperienceController@destroy');
