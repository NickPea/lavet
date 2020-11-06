<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Listing;
use App\Event;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function firstLoad()
    {
        $results = collect();

        $results->push(Profile::all());
        $results->push(Listing::all());
        $results->push(Event::all());

        return view('welcome', ['data' => $results]);
    }


    public function search(Request $request)
    {

        $keyword = $request->what;
        $location = $request->where;
        $profile_is_checked = isset($request->include_profiles);
        $listing_is_checked = isset($request->include_listings);
        $event_is_checked = isset($request->include_events);


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
                                    ->orWhereHas('user', function ($query) use($keyword)
                                    {
                                        $query->where('name', 'like',"%{$keyword}%");
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
                                $query->whereHas('user', function ($query) use ($keyword)
                                {
                                    $query->where('name', 'like', "%{$keyword}%");
                                });
                            })
                            ->orWhereHas('comment', function ($query) use ($keyword) {
                                $query->where('about', 'like', "%{$keyword}%")
                                ->orWhereHas('user', function ($query) use ($keyword)
                                {
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


        return view('welcome', ['data' => $results]);
    }
}
