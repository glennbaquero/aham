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
                'model' => $item->invoice_items,
                'users' => $item->user,
                // 'invoices' => $item->user,
                'requests' => $item,
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

        $userproducts = [];

        if ($id) {
            $item = RepairServiceRequest::with('user', 'repairman')->withTrashed()->find($id);
            $userproducts = $item->invoice_items()->pluck('id')->toArray();
        }
        
        $users = User::select(User::MINIMAL_COLUMNS)->get();
        $repairmen = RepairMan::all();
        $statuses = RepairServiceRequest::getStatus();

        return response()->json([
            'item' => $item,
            'users' => $users,
            'statuses' => $statuses,
            'repairmen' => $repairmen,
            'userproducts' => $userproducts,
        ]);
    }

    public function fetchUserInvoiceItems(Request $request) {
        $invoiceitem = User::getInvoiceItems($request);
        return response()->json([
            'invoice_items' => $invoiceitem,
        ]);
    }
}
