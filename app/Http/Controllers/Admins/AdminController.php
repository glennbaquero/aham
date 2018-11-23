<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;

use App\Admin;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.superadmin.administrator.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.superadmin.administrator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        DB::beginTransaction();
        $admin = Admin::store($request);
        DB::commit();

        return response()->json([
            'message' => 'Verification link is sent to their email',
            'redirect' => $admin->renderView(),
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.superadmin.administrator.edit', [
            'admin' => Admin::withTrashed()->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {

        $admin = Admin::withTrashed()->find($id);

        DB::beginTransaction();
        $admin = Admin::store($request, $admin);
        DB::commit();

        return response()->json([
            'message' => 'You have successfully updated the admin'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        return response()->json([
            'message' => "You have successfully archived {$admin->renderName()}",
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
        $admin = Admin::onlyTrashed()->find($id);
        $admin->restore();

        return response()->json([
            'message' => "You have successfully restored {$admin->renderName()}",
        ]);
    }
}
