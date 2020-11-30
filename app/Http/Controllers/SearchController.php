<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Listing;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{

    // profile-results
    public function retrieveSearchProfile(Request $request)
    {
        $results = $this->getProfileResults($request);

        return view( 'search-profile.template', ['results' => $results]);
    }

    //listing-results
    public function retrieveSearchListing(Request $request)
    {
        $results = $this->getListingResults($request);

        return view( 'search-listing.template', ['results' => $results]);
    }

    //event-results
    public function retrieveSearchEvent(Request $request)
    {
        $results = $this->getEventResults($request);

        return view( 'search-event.template', ['results' => $results]);
    }



    /*
    PRIVATE HELPERS
    ********************************************************************************************* */


    protected function getListingResults(Request $request)
    {

        $what = $request->what;
        $where = $request->where;

        return Listing::select('*')
            /** $keyword */
            ->when(isset($what), function ($query) use ($what) {
                $query
                    ->where('title', 'like', "%{$what}%")
                    ->orWhere('about', 'like', "%{$what}%")
                    ->orWhereHas('business', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%")
                            ->orWhereHas('user', function ($query) use ($what) {
                                $query->where('name', 'like', "%{$what}%");
                            });
                    })
                    ->orWhereHas('employ_type', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('tag', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('skill', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('field', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('position', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    });
            })
            /** location */
            ->when(isset($where), function ($query) use ($where) {
                $query
                    ->whereHas('location', function ($query) use ($where) {
                        $query->whereHas('city', function ($query) use ($where) {
                            $query->where('name', 'like', "%{$where}%");
                        })
                            ->orWhereHas('province', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('country', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('area_code', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            });
                    });
            })
            ->get();
    } //getListingResults()


    /* ********************************************************************************************* */


    public function getProfileResults(Request $request)
    {
        $what = $request->what;
        $where = $request->where;

        return Profile::select('*')
            /** $keyword */
            ->when(isset($what), function ($query) use ($what) {
                $query
                    ->where('work_status', 'like', "%{$what}%")
                    ->orWhere('about', 'like', "%{$what}%")
                    ->orWhereHas('user', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('field', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('position', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    });
            })
            /** location */
            ->when(isset($where), function ($query) use ($where) {
                $query
                    ->whereHas('location', function ($query) use ($where) {
                        $query->whereHas('city', function ($query) use ($where) {
                            $query->where('name', 'like', "%{$where}%");
                        })
                            ->orWhereHas('province', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('country', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('area_code', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            });
                    });
            })
            ->get();
    } //getProfileResults()


    /* ********************************************************************************************* */


    public function getEventResults(Request $request)
    {
        $what = $request->what;
        $where = $request->where;

        return Event::select('*')
            /** $keyword */
            ->when(isset($what), function ($query) use ($what) {
                $query
                    ->where('title', 'like', "%{$what}%")
                    ->orWhere('about', 'like', "%{$what}%")
                    ->orWhereHas('user', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('tag', function ($query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('rsvp', function ($query) use ($what) {
                        $query->whereHas('user', function ($query) use ($what) {
                            $query->where('name', 'like', "%{$what}%");
                        });
                    })
                    ->orWhereHas('comment', function ($query) use ($what) {
                        $query->where('about', 'like', "%{$what}%")
                            ->orWhereHas('user', function ($query) use ($what) {
                                $query->where('name', 'like', "%{$what}%");
                            });
                    });
            })
            /** location */
            ->when(isset($where), function ($query) use ($where) {
                $query
                    ->whereHas('location', function ($query) use ($where) {
                        $query->whereHas('city', function ($query) use ($where) {
                            $query->where('name', 'like', "%{$where}%");
                        })
                            ->orWhereHas('province', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('country', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('area_code', function ($query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            });
                    });
            })
            ->get();
    }//getEventResults()


}//controller