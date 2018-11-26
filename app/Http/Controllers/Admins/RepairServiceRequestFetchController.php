<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\FetchController;

use App\RepairServiceRequest;
use App\User;
use App\Product;
use App\UserProduct;
use App\RepairMan;

class RepairServiceRequestFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new RepairServiceRequest;
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
                'model' => $item->userproduct,
                'users' => $item->user,
                'complaint' => $item->complaint,
                'created_at' => $item->created_at->format('M d, Y (H:i:s)'),
                'status' => $item->status,

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

        $userproducts = null;

        if ($id) {
            $item = RepairServiceRequest::with('user', 'repairman')->withTrashed()->find($id);
            $userproducts = $item->userproduct()->get();
        }
        
        $users = User::with('userdetail', 'userproducts')->get();
        $repairmen = RepairMan::all();

        return response()->json([
            'item' => $item,
            'users' => $users,
            'repairmen' => $repairmen,
            'userproducts' => $userproducts !== null ? $userproducts : null,
        ]);
    }
}
