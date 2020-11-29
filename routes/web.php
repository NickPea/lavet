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


// PROFILE

// --retrieve
Route::get('profile/{profile}/image', 'ProfileController@retrieveProfileImage'); 
Route::get('profile/{profile}/user-images', 'ProfileController@retrieveProfileUserImages'); 
Route::get('profile/{profile}/name', 'ProfileController@retrieveProfileName'); 
Route::get('profile/{profile}/field', 'ProfileController@retrieveProfileField'); 
Route::get('profile/{profile}/position', 'ProfileController@retrieveProfilePosition'); 
Route::get('profile/{profile}/location', 'ProfileController@retrieveProfileLocation'); 
Route::get('profile/{profile}/about', 'ProfileController@retrieveProfileAbout'); 
Route::get('profile/{profile}/credential', 'ProfileController@retrieveProfileCredential'); 
Route::get('profile/{profile}/experience', 'ProfileController@retrieveProfileExperience'); 
Route::get('profile/{profile}/reference', 'ProfileController@retrieveProfileReference'); 

// -- update
Route::put('profile/{profile}/image', 'ProfileController@updateProfileImage'); 
Route::put('profile/{profile}/name', 'ProfileController@updateProfileName'); 
Route::put('profile/{profile}/about', 'ProfileController@updateProfileAbout'); 
Route::put('profile/{profile}/field', 'ProfileController@updateProfileField'); 
Route::put('profile/{profile}/position', 'ProfileController@updateProfilePosition'); 
Route::put('profile/{profile}/location', 'ProfileController@updateProfileLocation'); 
Route::put('profile/{profile}/credential', 'ProfileController@updateProfileCredential'); 
Route::put('profile/{profile}/experience', 'ProfileController@updateProfileExperience'); 
Route::put('profile/{profile}/reference', 'ProfileController@updateOrCreateProfileReference');

// -- store
Route::post('profile/{profile}/file-image', 'ProfileController@storeProfileFileImage');
Route::post('profile/{profile}/camera-image', 'ProfileController@storeProfileCameraImage');
Route::post('profile/{profile}/location', 'ProfileController@storeProfileLocation');
Route::post('profile/{profile}/credential', 'ProfileController@storeProfileCredential');
Route::post('profile/{profile}/experience', 'ProfileController@storeProfileExperience');

// --destroy
Route::delete('profile/{profile}/credential', 'ProfileController@destroyProfileCredential');
Route::delete('profile/{profile}/experience', 'ProfileController@destroyProfileExperience');








// Route::patch('profile/{profile}', 'ProfileController@update');

Route::get('listing/{listing}', 'ListingController@show');
Route::get('event/{event}', 'EventController@show');

Route::delete('experience/{experience}', 'ExperienceController@destroy');
