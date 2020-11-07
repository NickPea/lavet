<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Listing;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{

    public function welcome()
    {
        return view('welcome.welcome');
    }

    public function searchResultsPartial(Request $request)
    {
        $results = $this->retrieveData($request);
        return view('search._search-results', ['data' => $results]);
    }







    /*********************************************************************
     * helper functions
     */

    protected function retrieveData($request)
    {

        $keyword = $request->what;
        $location = $request->where;
        $profile_is_checked = isset($request->profile_check);
        $listing_is_checked = isset($request->listing_check);
        $event_is_checked = isset($request->event_check);

        /** returned results bag */
        $results = collect();

        /**
         * if include_profiles = true, search profiles by: username, fields, positions, about_me, work_status
         */

        if ($profile_is_checked) {
            $results->push(
                Profile::select('*')
                    /** $keyword */
                    ->when(isset($keyword), function ($query) use ($keyword) {
                        $query
                            ->where('work_status', 'like', "%{$keyword}%")
                            ->orWhere('about', 'like', "%{$keyword}%")
                            ->orWhereHas('user', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('field', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('position', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            });
                    })
                    /** location */
                    ->when(isset($location), function ($query) use ($location) {
                        $query
                            ->whereHas('location', function ($query) use ($location) {
                                $query->whereHas('city', function ($query) use ($location) {
                                    $query->where('name', 'like', "%{$location}%");
                                })
                                    ->orWhereHas('province', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    })
                                    ->orWhereHas('country', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    })
                                    ->orWhereHas('area_code', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    });
                            });
                    })
                    ->get()
            );
        } else {
            $results->push(collect()); //push empty collection
        }




        /**
         * if include_listings = true, search listings by: username, fields, positions, about_me, work_status
         */

        if ($listing_is_checked) {
            $results->push(
                Listing::select('*')
                    /** $keyword */
                    ->when(isset($keyword), function ($query) use ($keyword) {
                        $query
                            ->where('title', 'like', "%{$keyword}%")
                            ->orWhere('about', 'like', "%{$keyword}%")
                            ->orWhereHas('business', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%")
                                    ->orWhereHas('user', function ($query) use ($keyword) {
                                        $query->where('name', 'like', "%{$keyword}%");
                                    });
                            })
                            ->orWhereHas('employ_type', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('tag', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('skill', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('field', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('position', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            });
                    })
                    /** location */
                    ->when(isset($location), function ($query) use ($location) {
                        $query
                            ->whereHas('location', function ($query) use ($location) {
                                $query->whereHas('city', function ($query) use ($location) {
                                    $query->where('name', 'like', "%{$location}%");
                                })
                                    ->orWhereHas('province', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    })
                                    ->orWhereHas('country', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    })
                                    ->orWhereHas('area_code', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    });
                            });
                    })
                    ->get()
            );
        } else {
            $results->push(collect()); //push empty collection
        }

        /**
         * if include_profiles = true, search profiles by: username, fields, positions, about_me, work_status
         */

        if ($event_is_checked) {
            $results->push(
                Event::select('*')
                    /** $keyword */
                    ->when(isset($keyword), function ($query) use ($keyword) {
                        $query
                            ->where('title', 'like', "%{$keyword}%")
                            ->orWhere('about', 'like', "%{$keyword}%")
                            ->orWhereHas('user', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('tag', function ($query) use ($keyword) {
                                $query->where('name', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('rsvp', function ($query) use ($keyword) {
                                $query->whereHas('user', function ($query) use ($keyword) {
                                    $query->where('name', 'like', "%{$keyword}%");
                                });
                            })
                            ->orWhereHas('comment', function ($query) use ($keyword) {
                                $query->where('about', 'like', "%{$keyword}%")
                                    ->orWhereHas('user', function ($query) use ($keyword) {
                                        $query->where('name', 'like', "%{$keyword}%");
                                    });
                            });
                    })
                    /** location */
                    ->when(isset($location), function ($query) use ($location) {
                        $query
                            ->whereHas('location', function ($query) use ($location) {
                                $query->whereHas('city', function ($query) use ($location) {
                                    $query->where('name', 'like', "%{$location}%");
                                })
                                    ->orWhereHas('province', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    })
                                    ->orWhereHas('country', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    })
                                    ->orWhereHas('area_code', function ($query) use ($location) {
                                        $query->where('name', 'like', "%{$location}%");
                                    });
                            });
                    })
                    ->get()
            );
        } else {
            $results->push(collect()); //push empty collection
        }

        return $results->flatten();
    }


}
