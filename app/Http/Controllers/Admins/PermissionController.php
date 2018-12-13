<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Permission;
use App\Role;

class PermissionController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->syncPermissions($request->input('permissions'));

        return response()->json([
            'message' => "You have successfully update the {$role->renderName()}'s permissions.",
        ]);
    }
}
