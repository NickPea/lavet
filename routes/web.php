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

Auth::routes();


//HOME
Route::get('/', 'HomeController@retrieveTemplate');


// SEARCH

// --retrieve
Route::get('search/listing', 'SearchController@retrieveSearchListing');
Route::get('search/profile', 'SearchController@retrieveSearchProfile');
Route::get('search/event', 'SearchController@retrieveSearchEvent');

// --retrieve counts
Route::get('search/event/count', 'SearchController@retrieveSearchEventCount');


// PROFILE

// --template
Route::get('profile/{profile}', 'ProfileController@retrieveTemplate');

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

// --store
Route::post('profile/{profile}/file-image', 'ProfileController@storeProfileFileImage');
Route::post('profile/{profile}/camera-image', 'ProfileController@storeProfileCameraImage');
Route::post('profile/{profile}/location', 'ProfileController@storeProfileLocation');
Route::post('profile/{profile}/credential', 'ProfileController@storeProfileCredential');
Route::post('profile/{profile}/experience', 'ProfileController@storeProfileExperience');

// --update
Route::put('profile/{profile}/image', 'ProfileController@updateProfileImage'); 
Route::put('profile/{profile}/name', 'ProfileController@updateProfileName'); 
Route::put('profile/{profile}/about', 'ProfileController@updateProfileAbout'); 
Route::put('profile/{profile}/field', 'ProfileController@updateProfileField'); 
Route::put('profile/{profile}/position', 'ProfileController@updateProfilePosition'); 
Route::put('profile/{profile}/location', 'ProfileController@updateProfileLocation'); 
Route::put('profile/{profile}/credential', 'ProfileController@updateProfileCredential'); 
Route::put('profile/{profile}/experience', 'ProfileController@updateProfileExperience'); 
Route::put('profile/{profile}/reference', 'ProfileController@updateOrCreateProfileReference');

// --destroy
Route::delete('profile/{profile}/credential', 'ProfileController@destroyProfileCredential');
Route::delete('profile/{profile}/experience', 'ProfileController@destroyProfileExperience');



// LISTING
Route::get('listing/{listing}', 'ListingController@show');

// --retrieve
// --store
// --update
// --destroy



// EVENT
Route::get('event/{event}', 'EventController@getTemplate');
Route::get('event/{event}/get-event-comments', 'EventController@getEventComments');
Route::get('event/{event}/get-event-attending-count', 'EventController@getEventAttendingCount');
Route::get('event/{event}/get-event-some-attending', 'EventController@getEventSomeAttending');
Route::get('event/{event}/get-event-attending-all-attendees', 'EventController@getEventAttendingAllAttendess');
Route::post('event/{event}/new-event-comment', 'EventController@newEventComment');
Route::post('event/{event}/new-event-reply-comment', 'EventController@newEventReplyComment');
Route::post('event/{event}/post-rsvp-to-event', 'EventController@postRsvpToEvent');


//PROFILE CHAT
Route::post('profile/{profile}/chat', 'ChatController@sendAndRefresh');
Route::get('profile/{profile}/chat', 'ChatController@refresh');


//SIDE CHAT
Route::get('sidechat/refresh-conversations', 'SideChatController@refreshConversations');
Route::post('sidechat/refresh-messenger', 'SideChatController@refreshMessenger');//TODO:change to get method
Route::post('sidechat/send-message', 'SideChatController@sendMessage');
Route::get('sidechat/refresh-total-unread-count', 'SideChatController@refreshTotalUnreadCount');
Route::post('sidechat/mark-conversation-messages-as-read', 'SideChatController@markConversationMessagesAsRead');
Route::post('sidechat/send-started-typing-hint', 'SideChatController@sendStartedTypingHint');
Route::post('sidechat/send-stopped-typing-hint', 'SideChatController@sendStoppedTypingHint');
Route::post('sidechat/add-conversation-from-profile-id', 'SideChatController@addConversationFromProfileId');
