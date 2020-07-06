<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationFetchController extends Controller
{
    public function fetch() {
        $locations = Location::orderBy('name', 'asc')->get();

        return response()->json([
            'locations' => $locations,
        ]);
    }
}
