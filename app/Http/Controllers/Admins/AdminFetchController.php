<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\FetchController;

use App\Admin;
use App\Role;

class AdminFetchController extends FetchController
{
	/**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Admin;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items)
    {
        $result = [];

        foreach($items as $item) {
            array_push($result, array(
                'id' => $item->id,
                'name' => $item->firstname. ''. $item->lastname,
                'email' => $item->email,
                'created_at' => $item->created_at->format('M d, Y (H:i:s)'),

                'actions' => array(
                    'view' => $item->renderView()
                )
            ));
        }

        return $result;
    }

    public function fetchItem($id = null)
    {
        $item = null;
        $roleIds = [];

        if ($id) {
            $item = Admin::withTrashed()->find($id);
            $roleIds = $item->roles()->pluck('id')->toArray();
        }

        $roles = Role::all();

        return response()->json([
            'item' => $item,
            'roleIds' => $roleIds,
            'roles' => $roles
        ]);
    }
}
