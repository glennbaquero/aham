<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRepairRequest;
use Illuminate\Http\Request;

use App\RepairServiceRequest;
use DB;

class RepairServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.repairservice.request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.repairservice.request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRepairRequest $request)
    {
        DB::beginTransaction();
        $repair = RepairServiceRequest::store($request);        
        DB::commit();

        return response()->json([
            'message' => 'A new request has been created!',
            'redirect' => $repair->renderView(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.repairservice.request.edit', [
            'request' => RepairServiceRequest::with('user')->withTrashed()->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRepairRequest $request, $id)
    {
        $repair = RepairServiceRequest::withTrashed()->find($id);
        DB::beginTransaction();
        RepairServiceRequest::store($request, $repair);        
        DB::commit();

        return response()->json([
            'message' => 'A new request has been updated!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repair = RepairServiceRequest::find($id);
        $repair->delete();

        return response()->json([
            'message' => "You have successfully archived {$repair->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $repair = RepairServiceRequest::onlyTrashed()->find($id);
        $repair->restore();

        return response()->json([
            'message' => "You have successfully restored {$repair->renderName()}",
        ]);
    }
}
