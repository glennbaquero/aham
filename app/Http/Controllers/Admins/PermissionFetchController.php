<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Role;
use App\PermissionCategory;

class PermissionFetchController extends Controller
{
    public function fetchItem($id)
    {
        $item = Role::withTrashed()->find($id);
        $item->permissions = $item->permissions()->pluck('id')->toArray();
        $categories = PermissionCategory::with('permissions')->get();

        return response()->json([
            'item' => $item,
            'categories' => $categories,
        ]);
    }
}
