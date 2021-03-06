{{-- ---------------------------------------- TODO ---------------------------------------------- --}}


{{-- 

// -- EDIT WIZARD: 
// -- -- TITLE
// -- -- EVENT IMAGE AND TAGS
// -- -- HOSTED BY (TO ADD COMPANY OR BUSINESS)
// -- -- ABOUT

// -- ADD A COMMENT - TICK
// -- REPLY TO A COMMENT - TICK


// -- ATTEND AND UPDATE ATTENDING & REMAINING SEATS - TICK
// -- SEE ALL ATTENDING - TICK


// -- ADD AN EVENT WIZARD (FROM OTHER PAGES)


 --}}


{{-- ---------------------------------------- LAYOUT ---------------------------------------------- --}}



@extends('layouts.templates.app')



{{-- ---------------------------------------- HEAD ---------------------------------------------- --}}

@push('head')



{{-- SCRIPTS --}}

@include('event.scripts.event-store')
@include('event.scripts.event-reducers')
@include('event.scripts.event-endpoints')




@endpush

{{-- ---------------------------------------- BODY ---------------------------------------------- --}}



@push('body')

<!-- modals -->
@include('event.components.edit-modal')
@include('event.components.attending-all-modal')
@include('event.components.rsvp-prompt-modal')


<!-- header wrapper -->
<div>
    @include('event.components.header')
</div>


<!-- main content wrapper -->
<div>
    <div class="container mt-4">
        <div class="row">

            <!-- col one -->
            <div class="col-8">

                @include('event.components.visual')
    
            </div>

            <!-- col two -->
            <div class="col-4 d-flex flex-column">
    
                @include('event.components.hostedby')
                @include('event.components.details')
                @include('event.components.rsvp')
                @include('event.components.attending')
    
            </div>

        </div> <!-- //row -->
    </div> <!-- //container -->
</div>


<!-- about wrapper -->
<div style="background-color: rgba(255, 160, 122, 0.1)">
    <div class="container">
        <div class="row">
            <div class="col-8">

                @include('event.components.about')

            </div><!-- //col -->
        </div><!-- //row -->
    </div> <!-- //container -->
</div> <!-- end background container wrapper -->


<!-- comments wrapper -->
<div class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-8" >

                <!-- comments -->
                @include('event.components.comments')

            </div><!-- //col -->
        </div><!-- //row -->
    </div><!-- //container -->
</div><!-- //wrapper -->


@endpush

