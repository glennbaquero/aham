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
        if ($this->request->filled('search')) {
            $ids = $this->class::search($this->request->input('search'))->get()->pluck('id')->toArray();
            $query = $query->whereIn('id', $ids);
        }

        if ($this->request->filled('role')) {
            $query = $query->whereHas('roles', function($query) {
                $query->where('id', $this->request->input('role'));
            });
        }

        if ($this->request->filled('type')) {
            $query = $query->where('type', $this->request->input('type'));
        }

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
                'name' => $item->renderFullname(),
                'email' => $item->email,
                'role_list' => $item->renderRoleList(),
                'type_label' => $item->renderTypeLabel(),
                'type_class' => $item->renderTypeClass(),
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
        $types = Admin::getTypes();

        if ($id) {
            $item = Admin::withTrashed()->find($id);
            $roleIds = $item->roles()->pluck('id')->toArray();
        }

        $roles = Role::all();

        return response()->json([
            'item' => $item,
            'roleIds' => $roleIds,
            'roles' => $roles,
            'types' => $types,
        ]);
    }
}
