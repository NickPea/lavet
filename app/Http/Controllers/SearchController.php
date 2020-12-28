<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Listing;
use App\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    // profile-results
    public function retrieveSearchProfile(Request $request)
    {
        $request->flash();

        $results = $this->getProfileResults($request);

        return view('search-profile.template', ['results' => $results]);
    }

    //listing-results
    public function retrieveSearchListing(Request $request)
    {
        $request->flash();

        $results = $this->getListingResults($request);

        return view('search-listing.template', ['results' => $results]);
    }

    //event-results
    public function retrieveSearchEvent(Request $request)
    {
        $request->flash();

        $results = $this->getEventResults($request);

        return view('search-event.template', ['results' => $results]);
    }
   
    //event-result-count
    public function retrieveSearchEventCount(Request $request)
    {
        $result = $this->getEventResults($request);

        return response($result->total(), 200);
    }



    /*
    PRIVATE HELPERS
    ********************************************************************************************* */


    protected function getListingResults(Request $request)
    {

        $what = $request->what;
        $where = $request->where;

        return Listing::select('*')
            /** $what */
            ->when(isset($what), function (Builder $query) use ($what) {
                $query
                    ->where('title', 'like', "%{$what}%")
                    ->orWhere('about', 'like', "%{$what}%")
                    ->orWhereHas('business', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%")
                            ->orWhereHas('user', function (Builder $query) use ($what) {
                                $query->where('name', 'like', "%{$what}%");
                            });
                    })
                    ->orWhereHas('employ_type', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('tag', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('skill', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('field', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('position', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    });
            })
            /** $where */
            ->when(isset($where), function (Builder $query) use ($where) {
                $query
                    ->whereHas('location', function (Builder $query) use ($where) {
                        $query->whereHas('city', function (Builder $query) use ($where) {
                            $query->where('name', 'like', "%{$where}%");
                        })
                            ->orWhereHas('province', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('country', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('area_code', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            });
                    });
            })
            ->paginate(10);
    } //getListingResults()


    /* ********************************************************************************************* */


    public function getProfileResults(Request $request)
    {
        $what = $request->what;
        $where = $request->where;

        return Profile::select('*')
            /** $what */
            ->when(isset($what), function (Builder $query) use ($what) {
                $query
                    ->where('work_status', 'like', "%{$what}%")
                    ->orWhere('about', 'like', "%{$what}%")
                    ->orWhereHas('user', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('field', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('position', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    });
            })
            /** $where */
            ->when(isset($where), function (Builder $query) use ($where) {
                $query
                    ->whereHas('location', function (Builder $query) use ($where) {
                        $query->whereHas('city', function (Builder $query) use ($where) {
                            $query->where('name', 'like', "%{$where}%");
                        })
                            ->orWhereHas('province', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('country', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('area_code', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            });
                    });
            })
            ->paginate(10);
    } //getProfileResults()


    /* ********************************************************************************************* */


    public function getEventResults(Request $request)
    {
        $what = $request->what;
        $where = $request->where;

        return Event::select('*')
            /** $what */
            ->when(isset($what), function (Builder $query) use ($what) {
                $query
                    ->where('title', 'like', "%{$what}%")
                    ->orWhere('about', 'like', "%{$what}%")
                    ->orWhereHas('user', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('tag', function (Builder $query) use ($what) {
                        $query->where('name', 'like', "%{$what}%");
                    })
                    ->orWhereHas('rsvp', function (Builder $query) use ($what) {
                        $query->whereHas('user', function (Builder $query) use ($what) {
                            $query->where('name', 'like', "%{$what}%");
                        });
                    })
                    ->orWhereHas('comment', function (Builder $query) use ($what) {
                        $query->where('about', 'like', "%{$what}%")
                            ->orWhereHas('user', function (Builder $query) use ($what) {
                                $query->where('name', 'like', "%{$what}%");
                            });
                    });
            })
            /** where */
            ->when(isset($where), function (Builder $query) use ($where) {
                $query
                    ->whereHas('location', function (Builder $query) use ($where) {
                        $query->whereHas('city', function (Builder $query) use ($where) {
                            $query->where('name', 'like', "%{$where}%");
                        })
                            ->orWhereHas('province', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('country', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            })
                            ->orWhereHas('area_code', function (Builder $query) use ($where) {
                                $query->where('name', 'like', "%{$where}%");
                            });
                    });
            })
            ->paginate(5);
    } //getEventResults()


}//controller