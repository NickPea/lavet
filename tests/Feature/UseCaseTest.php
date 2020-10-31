<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UseCaseTest extends TestCase
{
     use RefreshDatabase;

     // protected function setUp(): void
     // {
     //      parent::setUp();
     //      $this->seed();
     //      $this->withoutExceptionHandling();
     // }

     /** @test scenario */
     public function application_business_behaviour_tests_in_progress()
     {
          $this->markTestIncomplete();
     }

     //GENERAL

     /** @test */
     public function setUpMultipleLocationRelationships()
     {
          $this->markTestSkipped('complete');         
     }
     

     //HOMEPAGE

     /** @test scenario */
     public function showSearchBarWithInitialLoadedResults()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function useSearchBarAndReturnResults()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function userSearchBarAndReturnResultsAsList()
     {
          $this->markTestIncomplete();
     }




     //STAFF PROFILE PAGE

     /** @test scenario */
     public function showStaffProfilePageWithAllAssociatedData()
     {
          $this->markTestIncomplete();
     }

     /** @test scenario */
     public function __showColleaguesViaAUserGivenReferences__basedOnWhetherReferencesHaveBeenAccepted()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function messageAStaffProfile()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function retriveMoreServeRenderedParialDataAsReferenceEtc()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function giveAStaffProfileAReference()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareStaffProfileViaEmail()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareStaffProfileViaSocialMedia()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareStaffProfileViaAMessage()
     {
          $this->markTestIncomplete();
     }

     //JOB PROFILE

     /** @test scenario */
     public function showJobProfileDataAndBusinessDataAndAllOtherAssociatedBusinessListingSummaries()
     {
          $this->markTestIncomplete();          
     }
     /** @test scenario */
     public function applyForAJobListing()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareJobProfileViaEmail()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareJobProfileViaSocialMedia()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareJobProfileViaAMessage()
     {
          $this->markTestIncomplete();
     }

     //EVENT PROFILE

     /** @test scenario */
     public function showEventDataAndAttendeesInCategoriesAndAttendeesComments()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function rsvpForEventAndOptToLeaveComment()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareEventProfileViaEmail()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareEventProfileViaSocialMedia()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function shareEventProfileViaAMessage()
     {
          $this->markTestIncomplete();
     }


     //HELP PAGE

     /** @test scenario */
     public function showHelpPage()
     {
          $this->markTestIncomplete();
     }

     //LOGIN PAGE

     /** @test scenario */
     public function showLoginAndRegistrationForm()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function LoginUserAndReturnToIntendedOrBackToCurrentPageAfterward()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function registerUserAccountAndContinueToSkippableFullProfileRegistrationThenReturnToProfilePageAfterward()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function replaceStaffLocationTableWithALocationApiLikeGoogle()
     {
          $this->markTestIncomplete();
     }

     //On Activity Page
     //Activity Page Sub-Navigation: 'Messages', 'Jobs', 'Events', .....eventually....'Groups', 'Forum/NewsFeed'

     //On Message-Activity Page

     /** @test scenario */
     public function showMessageBoxWithMessageHeadersAsRecipientInfoAndAListOfMessages()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function highlightMessageHeadersIfHasUnreadMessages()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function displayAListOfMessagesForSelectedMessageHeader()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function replyToMessages()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function editAndRemoveYourSentMessages()
     {
          $this->markTestIncomplete();
     }


     //On Job-Activity Page
     /*
     * - see a list of your recent job search activity (job details, dates viewed) or bookmarked/saved jobs
     * - see a list of jobs you've applied for
     * 
     * - display a list of your own job listings with business data, and thier job search activity
     * - edit & remove your own job listing
     * - create a brand new job listing
     */

     /** @test scenario */
     public function showJobSearchActivityAndSavedJobsAndAppliedJobsLists()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function showOwnedJobListingsWithBusinessDataAndJobSearchActivity()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function editAndRemoveOwnedJobListing()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function createAJob()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */

     //On Event-Activity Page
     /*
     * - display list of events that have activity (invited, or rsvp'd for), grouped by most recent with associated rsvp status and comment
     * - highlight events with rvsp status of invited, and allow button to rsvp
     * - display Countdown until event
     * 
     * - display a list of your own hosted events and buttons to CRUD/control them and their associated data
     /*

     /** @test scenario */
     public function showAnEventWithAttendeeGroupedByRsvpStatusAndWithAttendeeComments()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function highlightAndDisplayAnRsvpButtonForEventsThatRequireAnRsvp()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function displayEventCountdowns()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function showOwnHostedEventsWithAttendees()
     {
          $this->markTestIncomplete();
     }


     /*
     * On Settings Page
     * //Activity Page Sub-Navigation: 'Profile', 'Account', 'Notifications', 'Subscription' 'Logout'
     * 
     * On 'Profile-Settings' Page
     * - display profile summary
     * - display buttons to edit profile, manage references, update 'Available' Status]
     */

     /** @test scenario */
     public function showProfileSummaryWithButtonsToPreviewProfileAndEditDataAndManageReferencesAndUpdateAvailableStatus()
     {
          $this->markTestIncomplete();
     }

     /*
     * 
     * On 'Acount-Settings' Page
     * - change password
     * - edit notifications settings: notifications to toggle: weekly status quo email (workers and listings), message reminders emails
     * - show deactivate and delete account options with explanation
     */

     /** @test scenario */
     public function showSettingsWithOptionsToChangePasswordAndEditNotificationsAndDeactivateOrDeleteAccount()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */

     /*
     * On 'Notifications-Settings' Page
     * - show notification setting to with buttons to toggle and save
     * - edit notifications settings: notifications to toggle: weekly status quo email (workers and listings), message reminders emails
     */

     /** @test scenario */
     public function showNotificationSettingsWithOptionsToToggleAndSave()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function WeeklyStatusQuoNotificationExists()
     {
          $this->markTestIncomplete();
     }
     /** @test scenario */
     public function MessageReminderNotificationExists()
     {
          $this->markTestIncomplete();
     }

     /*
     * On 'Subscription-Settings' Page
     * - show subscription setting with current status and options to upgrade, downgrade, or cancel service
     */

     /** @test scenario */
     public function showSubscriptionSettingWithOptionsToUpgradeOrDowngradeOrCancelService()
     {
          $this->markTestIncomplete();
     }

     /*
     * On 'Logout-Settings' Page
     * - display pop-up etc to logout.
     */

     /** @test scenario */
     public function showConfirmationPopUpOnLogOut()
     {
          $this->markTestIncomplete();
     }



     /*
     Use Cases: 
     * On the homepage
     * - display a searchbar defaulted to 'all' with further filters for staff, jobs, events etc and associated sub-filters
     * - dispaly an array of searcbar results (defaulted to 'all) on inital load 
     * - display results as profile/job/& event cards or as lists
     * 
     * //Main App Navigation: 'Staff', 'Jobs', 'Events', (guest)"Help & Login" or (logged-in)"Activity and'Settings"
     * 
     *                      ********** a user clicks on a staff/job/or event navigation link *************
     * 
     * - just changes the current searchbar filters and injects associated data into homepage layout
     * 
     *                      ********** a user clicks on a staff/job/or event profile *************
     * 
     * On staff profile page
     * - display all the staff data with associated references
     * - message the staff profile (user)
     * - give the staff profile a reference to be later accepted by the user in their settings
     * - button share (email) profile
     * 
     * On job profile page
     * - display all the job data, business data, and other related job listings
     * - apply for the listing if logged in )
     * - button share (email) profile

     * On event profile page
     * - display all the event data, attendee (invited, attending, declined), and attendee comments
     * - rsvp for event and opt to leave comment
     * - button share (email) profile
     * 
     *                      ********** a user clicks on a help navigation link *************
     * 
     * On Help Page
     * - display static infographics with whys & how-tos
     * 
     *                      ********** a user clicks on a login navigation link *************
     * 
     * On Login Page
     * - display form to register or login. 
     * : Login user return to intended page or back to current page
     * : Registering user run through filling out profile forms with constant options to skip through (probably user javascript for this)
     * 
     *                      ******** user clicks on activity navigation button ********
     * 
     * On Activity Page
     * //Activity Page Sub-Navigation: 'Messages', 'Jobs', 'Events', .....'Groups', 'Forum/NewsFeed'
     * 
     * On Message-Activity Page
     * 
     * NB: messages can be anything sent by a user including reminders to accept references, event information etc.
     * 
     * - display a list of message-headers with some associated user profile/s data (contact image, name, etc)
     * - highlight message-headers with unread messages
     * - display list of messages of currently selected message header
     * - reply to messages
     * - edit your own sent messages
     * - remove your own sent messages
     * 
     * On Job-Activity Page
     * - see a list of your recent job search activity (job details, dates viewed) or bookmarked/saved jobs
     * - see a list of jobs you've applied for
     * 
     * - display a list of your own job listings with business data, and thier job search activity
     * - edit & remove your own job listing
     * - create a brand new job listing
     *
     * On Event-Activity Page
     * - display list of events that have activity (invited, or rsvp'd for), grouped by most recent with associated rsvp status and comment
     * - highlight events with rvsp status of invited, and allow button to rsvp
     * - display Countdown until event
     * 
     * - display a list of your own hosted events and buttons to CRUD/control them and their associated data
     * 
     * ....On Group-Activity Page
     * 
     * .....On Forum/NewsFeed-Activity Page
     * 
     *                      ******** user click on Settings navigation button ********
     * 
     * On Settings Page
     * //Activity Page Sub-Navigation: 'Profile', 'Account', 'Logout'
     * 
     * On 'Profile-Settings' Page
     * - display profile card
     * - display buttons to [Crud profile, manage references, update 'Available' Status]
     * 
     * On 'Acount-Settings' Page
     * - change password
     * - edit notifications settings: notifications to toggle: weekly status quo email (workers and listings), message reminders emails
     * - show deactivate and delete account options with explanation
     * 
     * On 'Logout-Settings' Page
     * - display pop-up etc to logout.
     */
}
