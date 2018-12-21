<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LocationPost;

use DB;

use App\Location;

class LocationController extends Controller
{

    public function __construct()
    {
        $this->middleware('App\Http\Middleware\Admins\Locations\LocationIndexMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\Admins\Locations\LocationStoreMiddleware', ['only' => ['create', 'store']]);
        $this->middleware('App\Http\Middleware\Admins\Locations\LocationUpdateMiddleware', ['only' => ['edit', 'update']]);
        $this->middleware('App\Http\Middleware\Admins\Locations\LocationDestroyMiddleware', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::select(Location::TABLE_COLUMNS);

        return view('admin.locations.index', [
            'locations' => $locations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationPost $request)
    {
        DB::beginTransaction();

        $location = Location::store($request);

        DB::commit();

        return response()->json([
            'message' => 'You have successfully create a new Location',
            'redirect' => $location->renderView(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::withTrashed()->find($id);

        return view('admin.locations.edit', [
            'location' => $location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationPost $request, $id)
    {
        $location = Location::withTrashed()->find($id);

        DB::beginTransaction();

        $location = Location::store($request, $location);

        DB::commit();

        return response()->json([
            'message' => "You have successfully updated {$location->renderName()}",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::withTrashed()->find($id);
        $location->delete();

        return response()->json([
            'message' => "You have successfully archived {$location->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $location = Location::onlyTrashed()->find($id);
        $location->restore();

        return response()->json([
            'message' => "You have successfully restored {$location->renderName()}",
        ]);
    }
}
